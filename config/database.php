<?php
class Database
{
    private $server;
    private $username;
    private $password;
    private $dbname;

    protected function connect()
    {
        $this->server = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "shopping_list";

        $conn = new mysqli($this->server, $this->username, $this->password, $this->dbname);
        return $conn;
    }
}
