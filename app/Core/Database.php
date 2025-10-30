<?php
namespace App\Core;

use PDO; 
use PDOException;

class Database {

    private $host = 'localhost';     
    private $port = '5432';          
    private $db_name = 'db_ivss';   
    private $username = 'postgres';     
    private $password = '0806';      

    private static $conn = null; 

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