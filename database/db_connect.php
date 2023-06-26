<?php

class db_connect {
    private $conn;
    private $host;
    private $username;
    private $password;
    private $database;

    //connecting to database
    public function connect() {
        $this->host = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "drugdispensing";

        //connecting to mysql database
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        //return database handler
        return $this->conn;
    }
}

?>
