<?php

namespace App\Infra\Database;

class MySqlDatabase
{
    private $conn;
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->username = $_ENV['DB_NAME'];
        $this->password = $_ENV['DB_USER'];
        $this->database = $_ENV['DB_BASE'];

        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function query($sql)
    {
        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }

        return $result;
    }

    public function escapeString($string)
    {
        return mysqli_real_escape_string($this->conn, $string);
    }

    public function close()
    {
        mysqli_close($this->conn);
    }
}
