<?php
namespace App\Core;

use PDO; 
use PDOException;

class Database {
    private $host;
    private $port;
    private $db_name;
    private $username;
    private $password;

    private static $conn = null; 

    public function __construct() {
        $this->host     = $_ENV['DB_HOST'];
        $this->port     = $_ENV['DB_PORT'];
        $this->db_name  = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
    }

    public function getConnection() {
        self::$conn = null; 
        
        $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";
        
        try {
            self::$conn = new PDO(
                $dsn,
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_PERSISTENT => false, 
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
            
            $test = self::$conn->query("SELECT version()");
            $version = $test->fetchColumn();
            error_log("✅ Connected to PostgreSQL: " . $version);
            
        } catch (PDOException $exception) {
            error_log("❌ Connection error: " . $exception->getMessage()); 
            throw new \Exception("Database connection failed: " . $exception->getMessage());
        }
        
        return self::$conn;
    }
}