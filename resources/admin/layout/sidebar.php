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
    <title>Aduca - Admin</title>
</head>

<?php
global $c;
global $a;
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
                <div class="toggle-icon ms-auto"><a href="#"><i class='bx bx-arrow-back'></i></a>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="/admin/dashboard">
                        <div class="parent-icon"><i class='bx bx-home-alt'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Manage Instructor</div>
                    </a>
                    <ul>
                        <li> <a href="/admin/manage-instructor"><i class='bx bx-radio-circle'></i>All Instructor</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-cart'></i>
                        </div>
                        <div class="menu-title">Manage Category</div>
                    </a>
                    <ul>
                        <li> <a href="/admin/manage-category"><i class='bx bx-radio-circle'></i>All Category</a>
                        </li>
                        <li> <a href="/admin/add-category"><i class='bx bx-radio-circle'></i>Add Category</a>
                        </li>
                        <li> <a href="/admin/manage-subcategory"><i class='bx bx-radio-circle'></i>All SubCategory</a>
                        </li>
                        <li> <a href="/admin/add-subcategory"><i class='bx bx-radio-circle'></i>Add SubCategory</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                        </div>
                        <div class="menu-title">Manage Course</div>
                    </a>
                    <ul>
                        <li> <a href="/admin/all/course"><i class='bx bx-radio-circle'></i>All Course</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-repeat"></i>
                        </div>
                        <div class="menu-title">Manage Coupon</div>
                    </a>
                    <ul>
                        <li> <a href="/admin/all/coupon"><i class='bx bx-radio-circle'></i>All Coupon</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-donate-blood"></i>
                        </div>
                        <div class="menu-title">Manage Orders</div>
                    </a>
                    <ul>
                        <li> <a href="/admin/pending/order"><i class='bx bx-radio-circle'></i>Pending Orders</a>
                        </li>
                        <li> <a href="/admin/confirm/order"><i class='bx bx-radio-circle'></i>Confirm Orders</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>