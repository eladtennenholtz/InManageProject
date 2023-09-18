<?php

require_once 'Database.php';
require_once 'TableCreator.php';
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

$dataBase->disconnect();

?>