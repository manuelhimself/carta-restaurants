<?php

class DataBase
{
    private $host = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $db_name = "restaurants";

    public function connect()
    {
        $con = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        return $con;
    }
    
}
