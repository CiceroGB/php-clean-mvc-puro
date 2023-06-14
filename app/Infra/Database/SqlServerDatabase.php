<?php

namespace App\Infra\Database;


use PDO;
use PDOException;
use App\Infra\Database\ISqlServerDatabase;

class SqlServerDatabase implements ISqlServerDatabase
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
        $this->password = $_ENV['DB_PASS'];
        $this->database = $_ENV['DB_BASE'];

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
            throw $e;  
        }
    }

    public function escapeString($string)
    {
        // PDO provides built-in mechanisms for safe SQL statements,
        // so it's generally better to use prepared statements instead of manually escaping strings.
        // This method is kept for compatibility but it's recommended to avoid using it.
        return $this->conn->quote($string);
    }

    // Adicione este método na sua classe SqlServerDatabase
    public function prepare($sql)
    {
        try {
            $stmt = $this->conn->prepare($sql);
            return $stmt;
        } catch (PDOException $e) {
            throw $e;  
        }
    }


    public function close()
    {
        $this->conn = null;
    }
}
