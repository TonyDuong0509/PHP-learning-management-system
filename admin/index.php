<?php
require '../vendor/autoload.php';

session_start();

require  '../config.php';
require  '../connectDB.php';
include  '../bootstrap.php';

require '../Container/RegisteDJ.php';

require '../Routes/web.php';

if ($match === false) {
    header("Location: /admin/dashboard");
    exit;
}

$publicRoutes = [
    'admin.login',
    'admin.login.form'
];

if (!isset($_SESSION['admin']['email']) && !in_array($match['name'], $publicRoutes)) {
    header("Location: /admin/login/form");
    exit;
}

if (isset($match['target']) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header("Location: /404.php");
    exit;
}
