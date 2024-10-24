<?php

namespace Router\Web;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
    case '/':

        include 'views/main.php';
        break;

    case '/users':

        include 'views/users.php';
        break;

    case '/add':

        include 'views/form.html';
        break;

    case '/home':

        $template = $twig->load('home.html.twig');
        echo $template->render(['text' => 'Welcome to the home page!']);
        break;

    default:

        if (preg_match('/^\/users\/(\d+)\/?$/', $requestUri, $matches)) {
            $userId = $matches[1];
            include 'views/user.php';
        } else {

            include 'views/404.php';
        }
        break;
}
