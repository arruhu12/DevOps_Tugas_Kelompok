<?php
class Database{
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    function __construct($host, $user, $pass, $database){
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;

        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->database, 3306) or die(mysql_error());

        if(!$this->conn){
            return false;
        }else{
            return true;
        }
    }
}
