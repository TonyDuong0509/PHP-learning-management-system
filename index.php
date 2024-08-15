<?php
session_start();

require 'vendor/autoload.php';

$router = new AltoRouter();

require 'config.php';

require ABSPATH . 'connectDB.php';

require ABSPATH . 'bootstrap.php';

require ABSPATH . 'Container/RegisteDJ.php';

require 'Routes/web.php';

$match = $router->match();
$routeName = is_array($match) ? ($match['name'] ?? null) : null;

if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    $c = $_GET['c'] ?? 'home';
    $a = $_GET['a'] ?? 'index';

    $strController = ucfirst($c) . 'Controller';
    $controllerClass = "App\\Controllers\\User\\$strController";

    $controller = $serviceContainer->resolve($controllerClass);

    $controller->$a();
}
