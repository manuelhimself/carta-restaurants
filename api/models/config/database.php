<?php

class DataBase
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "restaurat";



    public function connect()
    {
        $con = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        return $con;
    }
    
}
