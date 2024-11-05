<?php
namespace Router\Web;

use Controllers\UserController;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

$controller = new UserController();

switch ($requestUri) {
    case '/':
        $controller->index();
        break;

    case '/users':
        $controller->listUsers();
        break;

    case '/add':
        $controller->addUserForm();
        break;

    case '/addUser':
        $controller->addUser();
        break;

    case '/list':
        $controller->paginateUsers();
        break;

    default:
        if (preg_match('/^\/users\/(\d+)\/?$/', $requestUri, $matches)) {
            $userId = $matches[1];

            if ($requestMethod === 'GET') {
                $controller->viewUser($userId);
            } elseif ($requestMethod === 'DELETE') {
                $controller->deleteUser($userId);
            } else {
                http_response_code(405); // Method Not Allowed
                echo "Method not allowed";
            }
        } else {
            include 'views/404.html';
        }
        break;
}
