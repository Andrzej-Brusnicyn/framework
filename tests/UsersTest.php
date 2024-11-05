<?php
require_once __DIR__ . '/../models/UserModel.php';
use PHPUnit\Framework\TestCase;
use Models\UserModel;
use Database\DatabaseConnection;
final class UsersTest extends TestCase {

    private $database;

    protected function setUp(): void {

        $this->database = new UserModel();
    }

    public function testSetUser() {

        $name = 'John Doe';
        $email = 'john.doe@example.com';
        $password = 'password123';
        $gender = 'm';
        $status = 'a';

        $result = $this->database->setUser($name, $email, $password, $gender, $status);

        $this->assertTrue($result);

        $user = $this->database->getUser($email);
        $this->assertEquals($name, $user['name']);
        $this->assertEquals($email, $user['email']);
        $this->assertEquals($gender, $user['gender']);
        $this->assertEquals($status, $user['status']);
    }

    protected function tearDown(): void {
        $email = 'john.doe@example.com';
        $user = $this->database->getUser($email);
        $this->database->deleteUserById($user['id']);
    }
}
