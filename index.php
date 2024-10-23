<?php
require_once 'database/Database.php';
$database = Database::getInstance();
require('router/web.php');
