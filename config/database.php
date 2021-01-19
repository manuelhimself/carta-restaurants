<?php

class DataBase
{
    private $host = "51.103.34.143";
    private $username = "root";
    private $password = "password";
    private $db_name = "restaurant";

    public function connect()
    {
        $con = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        return $con;
    }
}
