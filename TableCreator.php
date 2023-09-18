<?php

class TableCreator {
    private $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function createUsersTable() {
        $usersTableCreateSQL = "
            CREATE TABLE Users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                active ENUM('yes', 'no') NOT NULL
            )
        ";

        return $this->database->createTable($usersTableCreateSQL);
    }

    public function createPostsTable() {
        $postsTableCreateSQL = "
            CREATE TABLE Posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                title VARCHAR(255) NOT NULL,
                body TEXT NOT NULL,
                created_at DATETIME NOT NULL,
                active ENUM('yes', 'no') NOT NULL
            )
        ";

        return $this->database->createTable($postsTableCreateSQL);
    }
}
?>