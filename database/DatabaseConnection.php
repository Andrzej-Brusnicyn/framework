<?php

namespace Database;

use PDO;

class DatabaseConnection
{
    private static ?DatabaseConnection $instance = null;
    private ?PDO $conn = null;

    private string $host = 'docker.postgres';
    private string $db_name = 'lms';
    private string $username = 'postgres';
    private string $password = 'postgres';

    private function __construct()
    {
        $this->conn = new PDO("pgsql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(): DatabaseConnection
    {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}
