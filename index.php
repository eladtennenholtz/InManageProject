<?php

require_once 'Database.php';
require_once 'TableCreator.php';
require_once 'CurlHandler.php'; 
require_once 'Utils.php';
$hostname = 'localhost';  
$username = 'root';  
$password = '';  
$database = 'eladdb';
$dataBase = new Database($hostname,$username,$password,$database); 
$conn = $dataBase->connect();
if (!$conn) {
    die("Connection failed.");
}
$tableCreator = new TableCreator($dataBase);

if ($tableCreator->createUsersTable()) {
    echo "Table 'Users' created successfully.";
} else {
    echo "Error creating 'Users' table.";
}

if ($tableCreator->createPostsTable()) {
    echo "Table 'Posts' created successfully.";
} else {
    echo "Error creating 'Posts' table.";
}
$curlHandler = new CurlHandler();
$curlHandler->fetchAndInsertUsers($conn);
$curlHandler->fetchAndInsertPosts($conn);



$imageUrl = 'https://cdn2.vectorstock.com/i/1000x1000/23/81/default-avatar-profile-icon-vector-18942381.jpg';
$localImagePath = 'images/image.jpg';

if (Utils::fetchAndSaveImage($imageUrl, $localImagePath)) {
    echo "Image saved successfully to $localImagePath";
} else {
    echo "Failed to fetch or save the image.";
}
$query = "
    SELECT users.id, users.name, users.email,posts.title, posts.body
    FROM users
    INNER JOIN posts ON users.id = posts.user_id
    WHERE users.active = 'yes' AND posts.active = 'yes'
";
$result = $dataBase->select($query);
Utils::displaySocialMediaStyleData($result,$localImagePath);

$dataBase->disconnect();

?>