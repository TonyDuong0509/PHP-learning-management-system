<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Aduca</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="<?php ABSPATH ?>/public/frontend/images/favicon.png">

    <!-- inject:css -->
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/line-awesome.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/fancybox.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/tooltipster.bundle.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/animated-headline.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/style.css">
    <!-- end inject -->
</head>

<?php
global $c;
global $a;
global $router;
?>

<body>

    <!-- start cssload-loader -->
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>

    <header class="header-menu-area bg-white">

        <?php require ABSPATH . 'resources/user/home/layout/headerTop.php' ?>

        <?php require ABSPATH . 'resources/user/home/layout/headerMenuContent.php' ?>

        <?php require ABSPATH . 'resources/user/home/layout/headerCanvasMenu.php' ?>

    </header>