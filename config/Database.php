<?php

class Database {
    private $host = "127.0.0.1";
    private $db_name = "phplogin_db";
    private $username = "root";
    private $password = "";

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

