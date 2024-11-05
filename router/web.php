<?php

namespace Router\Web;

use Controllers\UserController;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

$controller = new UserController();

switch ($requestUri) {
    case '/':
        include 'views/main.html';
        break;

    case '/users':
        $controller->index();
        break;

    case '/add':
        $controller->userForm();
        break;

    case '/addUser':
        $controller->addUser();
        break;

    case '/list':
        $controller->paginateUsers();
        break;

    default:
        if (preg_match('/^\/users\/(\d+)\/?$/', $requestUri, $matches)) {
            $userId = (int)$matches[1];

            if ($requestMethod === 'GET') {
                $controller->show($userId);
            } elseif ($requestMethod === 'DELETE') {
                $controller->delete($userId);
            } else {
                http_response_code(405);
                echo "Method not allowed";
            }
        } else {
            include 'views/404.html';
        }
        break;
}
