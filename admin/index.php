<?php

use Container\ServiceContainer;

session_start();

require '../vendor/autoload.php';
require '../config.php';
require '../connectDB.php';
include '../bootstrap.php';

$c = isset($_GET['c']) ? $_GET['c'] : 'dashboard';
$a = isset($_GET['a']) ? $_GET['a'] : 'index';

$publicActions = [
    'auth' => ['login', 'register'],
];

if (!isset($_SESSION['emailAdmin']) && !(isset($publicActions[$c]) && in_array($a, $publicActions[$c]))) {
    header("Location: login.php");
    exit;
}

$strController = ucfirst($c) . 'Controller';
$controllerClass = "App\\Controllers\\Admin\\$strController";

$serviceContainer = new ServiceContainer();

$serviceContainer->add(App\Repositories\Interfaces\UserRepositoryInterface::class, new App\Repositories\UserRepository());
$serviceContainer->add(App\Services\UserService::class, new App\Services\UserService($serviceContainer->resolve(App\Repositories\Interfaces\UserRepositoryInterface::class)));

$controller = $serviceContainer->resolve($controllerClass);
$controller->$a();
