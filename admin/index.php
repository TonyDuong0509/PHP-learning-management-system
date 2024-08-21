<?php
require '../vendor/autoload.php';

session_start();

require  '../config.php';
require  '../connectDB.php';
include  '../bootstrap.php';

require '../Container/RegisteDJ.php';

require '../Routes/web.php';

if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    $c = $_GET['c'] ?? 'dashboard';
    $a = $_GET['a'] ?? 'index';

    $publicActions = [
        'auth' => ['login', 'register'],
    ];

    if (!isset($_SESSION['emailAdmin']) && !(isset($publicActions[$c]) && in_array($a, $publicActions[$c]))) {
        header("Location: /admin/login.php");
        exit;
    }

    $strController = ucfirst($c) . 'Controller';
    $controllerClass = "App\\Controllers\Admin\\$strController";

    $controller = $serviceContainer->resolve($controllerClass);
    $controller->$a();
}
