<?php

namespace App\Core;

use PDO;
use PDOException;
use Exception;

class Database
{
    private string $host;
    private string $port;
    private string $dbName;
    private string $username;
    private string $password;
    private ?PDO $conn = null;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'] ?? 'postgres-db';
        $this->port = $_ENV['DB_PORT'] ?? '5432';
        $this->dbName = $_ENV['DB_DATABASE'] ?? 'db_ivss';
        $this->username = $_ENV['DB_USERNAME'] ?? 'ivss_user';
        $this->password = $_ENV['DB_PASSWORD'] ?? 'hB&4ySg9^rT*JzX%';
    }

    public function getConnection(): PDO
    {
        if ($this->conn !== null) {
            return $this->conn;
        }

        $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbName}";

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
            
            return $this->conn;
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }
}