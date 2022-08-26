<?php

class Database  {
    private $host = 'localhost';
    private $user = 'root';
    private $pass = 'root';
    private $db = 'blog';
    private $myconn;

    public function __construct()
    {
        try {
            $this->myconn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getMyconn(): bool|mysqli
    {
        return $this->myconn;
    }

//    public function connect() {
//        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
//        if (!$con) {
//            die('Could not connect to database!');
//        } else {
//            $this->myconn = $con;
//        }
//        return $this->myconn;
//    }

    function close() {
        mysqli_close($this->myconn);
    }

}