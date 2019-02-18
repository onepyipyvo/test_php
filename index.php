<?php
require "Controllers/Controller.php";
require "Models/Database.php";
require "Models/Model.php";
require "Models/Book.php";
require "Models/Author.php";
require 'Core/View.php';
require 'Core/Validation.php';
require 'Core/Upload.php';
$config = require "resources/config/config.php";
$dsn = "mysql:host=".$config['db_host'].";dbname=".$config['db_name'].";charset=".$config['db_charset'];
$pdo = new PDO($dsn, $config['db_user'], $config['db_password'], $config['db_options']);
$db = new Database($pdo);
$controller = new Controller($db, $config);
$controller->index();