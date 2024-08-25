<?php
require '../vendor/autoload.php';

session_start();

require  '../config.php';
require  '../connectDB.php';
include  '../bootstrap.php';

require '../Container/RegisteDJ.php';

require '../Routes/web.php';

$publicRoutes = [
    'admin.login',
    'admin.login.form'
];

if (!isset($_SESSION['emailAdmin']) && !in_array($match['name'], $publicRoutes)) {
    header("Location: /admin/login/form");
    exit;
}

if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo "404 not found";
}
