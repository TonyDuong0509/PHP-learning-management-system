<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="<?php ABSPATH ?>/public/backend/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="<?php ABSPATH ?>/public/backend/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="<?php ABSPATH ?>/public/backend/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?php ABSPATH ?>/public/backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?php ABSPATH ?>/public/backend/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="<?php ABSPATH ?>/public/backend/css/pace.min.css" rel="stylesheet" />
    <script src="<?php ABSPATH ?>/public/backend/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="<?php ABSPATH ?>/public/backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php ABSPATH ?>/public/backend/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="<?php ABSPATH ?>/public/backend/css/app.css" rel="stylesheet">
    <link href="<?php ABSPATH ?>/public/backend/css/icons.css" rel="stylesheet">
    <link href="<?php ABSPATH ?>/public/backend/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/backend/css/dark-theme.css" />
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/backend/css/semi-dark.css" />
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/backend/css/header-colors.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Aduca - Admin</title>
</head>

<?php
global $router;
?>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="<?php ABSPATH ?>/public/backend/images/logo-icon.png" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <h4 class="logo-text">Aduca</h4>
                </div>
                <div class="toggle-icon ms-auto"><a href="/"><i class='bx bx-arrow-back'></i></a>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="<?php echo $router->generate('dashboard'); ?>">
                        <div class="parent-icon"><i class='bx bx-home-alt'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <?php if (is_object($instructor) && $instructor->getStatus() == 1) : ?>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-category"></i>
                            </div>
                            <div class="menu-title">Manage Course</div>
                        </a>
                        <ul>
                            <li> <a href="<?php echo $router->generate('all.course'); ?>"><i class='bx bx-radio-circle'></i>All Course</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class='bx bx-cart'></i>
                            </div>
                            <div class="menu-title">Manage Orders</div>
                        </a>
                        <ul>
                            <li> <a href="/instructor/all/order"><i class='bx bx-radio-circle'></i>All Orders</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class='bx bx-cart'></i>
                            </div>
                            <div class="menu-title">Manage Questions</div>
                        </a>
                        <ul>
                            <li> <a href="/instructor/all/question"><i class='bx bx-radio-circle'></i>All Questions</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>