<?php
class Database {
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;

    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

    public function disconnect() {
        $this->conn = null;
    }

    public function select($query) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($query) {
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }

    public function update($query) {
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }

    public function delete($query) {
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }
    public function createTable($tableCreateSQL) {
        try {
            $stmt = $this->conn->prepare($tableCreateSQL);
            $stmt->execute();
            return true; // Table created successfully
        } catch (PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
            return false; // Error occurred while creating table
        }
    }
}
?>
