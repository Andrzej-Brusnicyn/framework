<?php

namespace Router\Web;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
    case '/':

        include 'views/main.html';
        break;

    case '/users':
        $users = $database->getAllUsers();
        $template = $twig->load('users.html.twig');
        echo $template->render(["users" => $users]);
        break;

    case '/add':

        include 'views/form.html';
        break;


    default:

        if (preg_match('/^\/users\/(\d+)\/?$/', $requestUri, $matches)) {
            $userId = $matches[1];
            $user = $database->getUserById($userId);
            $template = $twig->load('user.html.twig');
            echo $template->render(["user" => $user]);
        } else {

            include 'views/404.html';
        }
        break;
}
