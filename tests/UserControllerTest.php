<?php
require_once __DIR__ . '/../database/DatabaseConnection.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../models/User.php';
use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Controllers\UserController;
use Models\UserModel;
use Database\DatabaseConnection;

class UserControllerTest extends TestCase
{
    private UserController $controller;

    protected function setUp(): void
    {
        $this->controller = new UserController();
    }

    public function testIndexWithApiSource()
    {
        $_GET['source'] = 'api';

        $this->controller->index();
        $this->assertTrue(true);
    }

    public function testPaginateUsersWithApiSource()
    {
        $_GET['source'] = 'api';
        $_GET['page'] = 1;
        $_GET['limit'] = 5;

        $this->controller->paginateUsers();
        $this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        $_GET = [];
    }
}
