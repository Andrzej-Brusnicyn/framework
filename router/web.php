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
        if ($requestMethod === 'GET') {
            $controller->index();
        }
        elseif($requestMethod === 'POST') {
            $controller->store();
        }
        break;

    case '/new':
        $controller->userForm();
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
            }
        }
        elseif (preg_match('/^\/users\/(\d+)\/edit$/', $requestUri, $matches)) {
            $userId = (int)$matches[1];
            if ($requestMethod === 'POST') {
                $controller->update($userId);
            }
            else {
                $controller->edit($userId);
            }
        }
        else {
            include 'views/404.html';
        }
        break;
}
