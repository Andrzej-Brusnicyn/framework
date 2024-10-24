<?php

namespace Router\Web;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

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

            if ($requestMethod === 'GET') {
                $user = $database->getUserById($userId);
                $template = $twig->load('user.html.twig');
                echo $template->render(["user" => $user]);
            } elseif ($requestMethod === 'DELETE') {
                $database->deleteUserById($userId);
                echo "User $userId was deleted successful";
            } else {
                http_response_code(405); // Method Not Allowed
                echo "Method not allowed";
            }
        } else {
            include 'views/404.html';
        }
        break;
}
