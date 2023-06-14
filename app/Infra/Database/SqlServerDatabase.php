<?php

namespace App\Infra\Database;

use PDO;
use PDOException;

class SqlServerDatabase
{
    private $conn;
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->database = $_ENV['DB_NAME'];

        try {
            $this->conn = new PDO("sqlsrv:Server=$this->host;Database=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function query($sql)
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    public function escapeString($string)
    {
        // PDO provides built-in mechanisms for safe SQL statements,
        // so it's generally better to use prepared statements instead of manually escaping strings.
        // This method is kept for compatibility but it's recommended to avoid using it.
        return $this->conn->quote($string);
    }

    public function close()
    {
        $this->conn = null;
    }
}
