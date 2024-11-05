<?php
require_once 'database/DatabaseConnection.php';
require_once 'models/UserModel.php';
require_once 'controllers/UserController.php';
require_once 'vendor/autoload.php';

use Database\DatabaseConnection;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$database = DatabaseConnection::getInstance();
$loader = new FilesystemLoader('views/');
$twig = new Environment($loader);

require('router/web.php');
