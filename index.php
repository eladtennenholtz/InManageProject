<?php

require_once 'Database.php';
$hostname = 'localhost';  
$username = 'root';  
$password = '';  
$database = 'eladdb';
$dataBase = new Database($hostname,$username,$password,$database); 
$conn = $dataBase->connect();
if (!$conn) {
    die("Connection failed.");
}

$productTableCreateSQL = "
    CREATE TABLE products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL
    )
";

// Create the 'products' table
if ($dataBase->createTable($productTableCreateSQL)) {
    echo "Table 'products' created successfully.";
} else {
    echo "Error creating table.";
}

?>