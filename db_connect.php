<?php
class database
{
    public function __construct()
    {
        $host = "localhost";
        $dbname = "restoran";
        $username = "admin";
        $password = "admin";
        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    }
}
