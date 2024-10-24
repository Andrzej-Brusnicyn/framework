<?php
require_once 'database/Database.php';
$database = Database::getInstance();
require_once 'vendor/autoload.php';
$loader = new Twig\Loader\FilesystemLoader('views/');
$twig = new Twig\Environment($loader);
require('router/web.php');
