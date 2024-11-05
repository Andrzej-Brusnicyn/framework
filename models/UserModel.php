<?php

namespace Models;

use PDO;
use Database\DatabaseConnection;

class UserModel
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance()->getConnection();
    }

    public function setUser(string $name, string $email, string $password, string $gender, string $status): bool
    {
        $query = "INSERT INTO users (name, email, password, gender, status) VALUES (:name, :email, :password, :gender, :status)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    public function getUser(string $email): ?array
    {
        $query = "SELECT id, name, email, password, gender, status FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getAllUsers(): array
    {
        $query = "SELECT id, name, email FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById(int $id): ?array
    {
        $query = "SELECT id, name, email, gender, status FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function deleteUserById(int $id): bool
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
