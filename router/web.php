<?php

namespace Router\Web;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
    case '/':

        include 'pages/main.php';
        break;

    case '/users':

        include 'pages/users.php';
        break;

    case '/add':

        include 'form.html';
        break;

    default:

        if (preg_match('/^\/users\/(\d+)\/?$/', $requestUri, $matches)) {
            $userId = $matches[1];
            include 'pages/user.php';
        } else {

            include 'pages/404.php';
        }
        break;
}
