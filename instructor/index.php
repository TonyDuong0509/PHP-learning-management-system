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
    $c = $_GET['c'] ?? 'instructor';
    $a = $_GET['a'] ?? 'dashboard';

    $publicActions = [
        'instructor' => ['login', 'register'],
    ];

    if (!isset($_SESSION['emailInstructor']) && !(isset($publicActions[$c]) && in_array($a, $publicActions[$c]))) {
        header("Location: /instructor/login.php");
        exit;
    }

    $strController = ucfirst($c) . 'Controller';
    $controllerClass = "App\\Controllers\Instructor\\$strController";

    $controller = $serviceContainer->resolve($controllerClass);
    $controller->$a();
}
