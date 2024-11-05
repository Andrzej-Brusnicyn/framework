<?php
namespace Database;

use PDO;

class DatabaseConnection {
    private static $instance = null;
    private $conn = null;

    private $host = 'docker.postgres';
    private $db_name = 'lms';
    private $username = 'postgres';
    private $password = 'postgres';

    private function __construct() {
        $this->conn = new PDO("pgsql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
