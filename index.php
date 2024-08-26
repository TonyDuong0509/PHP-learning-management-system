<?php

session_start();

require 'vendor/autoload.php';

$router = new AltoRouter();

require 'config.php';

require ABSPATH . 'connectDB.php';

require ABSPATH . 'bootstrap.php';

require ABSPATH . 'Container/RegisteDJ.php';

require 'Routes/web.php';

if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo "404 not found";
}
