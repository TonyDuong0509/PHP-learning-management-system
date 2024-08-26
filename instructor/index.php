<?php

require '../vendor/autoload.php';

session_start();

require  '../config.php';
require  '../connectDB.php';
include  '../bootstrap.php';

require '../Container/RegisteDJ.php';

require '../Routes/web.php';

if ($match === false) {
    header("Location: /instructor/dashboard");
    exit;
}

$publicRoutes = [
    'instructor.login',
    'instructor.register',
    'instructor.login.form',
    'instructor.register.form',
];

if (!isset($_SESSION['instructor']['email']) && !in_array($match['name'], $publicRoutes)) {
    header("Location: /instructor/login/form");
    exit;
}

if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo "404 not found";
}
