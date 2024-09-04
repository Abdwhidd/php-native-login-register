<?php

class Database {
    private $host = "your host";
    private $db_name = "your database name";
    private $username = "your username";
    private $password = "your password";

    public $conn;


    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo 'Success connect...';
        } catch(PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }

        return $this->conn;
    }

}

$db = new Database();
$db->connect();