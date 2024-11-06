<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../database/DatabaseConnection.php';
use PHPUnit\Framework\TestCase;
use Models\UserModel;
use Database\DatabaseConnection;
class DatabaseTest extends TestCase
{
    private UserModel $model;
    private $testEmail = "test2@example.com";

    protected function setUp(): void
    {
        $this->model = new UserModel();
    }

    public function testSetUser()
    {
        $result = $this->model->setUser(
            "Test User",
            $this->testEmail,
            "password123",
            "m",
            "a"
        );

        $this->assertTrue($result);

        // Проверяем что пользователь действительно добавился
        $user = $this->model->getUser($this->testEmail);
        $this->assertNotNull($user);
        $this->assertEquals("Test User", $user['name']);
    }

    protected function tearDown(): void
    {
        $user = $this->model->getUser($this->testEmail);
        if ($user) {
            $this->model->deleteUserById($user['id']);
        }
    }
}
