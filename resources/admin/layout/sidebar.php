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
                    <a href="?c=dashboard&a=index">
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
                        <li> <a href="?c=dashboard&a=manageInstructor"><i class='bx bx-radio-circle'></i>All Instructor</a>
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
                        <li> <a href="?c=dashboard&a=manageCategory"><i class='bx bx-radio-circle'></i>All Category</a>
                        </li>
                        <li> <a href="?c=dashboard&a=addCategory"><i class='bx bx-radio-circle'></i>Add Category</a>
                        </li>
                        <li> <a href="?c=dashboard&a=manageSubCategory"><i class='bx bx-radio-circle'></i>All SubCategory</a>
                        </li>
                        <li> <a href="?c=dashboard&a=addSubCategory"><i class='bx bx-radio-circle'></i>Add SubCategory</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                        </div>
                        <div class="menu-title">Components</div>
                    </a>
                    <ul>
                        <li> <a href="component-alerts.html"><i class='bx bx-radio-circle'></i>Alerts</a>
                        </li>
                        <li> <a href="component-accordions.html"><i class='bx bx-radio-circle'></i>Accordions</a>
                        </li>
                        <li> <a href="component-badges.html"><i class='bx bx-radio-circle'></i>Badges</a>
                        </li>
                        <li> <a href="component-buttons.html"><i class='bx bx-radio-circle'></i>Buttons</a>
                        </li>
                        <li> <a href="component-cards.html"><i class='bx bx-radio-circle'></i>Cards</a>
                        </li>
                        <li> <a href="component-carousels.html"><i class='bx bx-radio-circle'></i>Carousels</a>
                        </li>
                        <li> <a href="component-list-groups.html"><i class='bx bx-radio-circle'></i>List Groups</a>
                        </li>
                        <li> <a href="component-media-object.html"><i class='bx bx-radio-circle'></i>Media Objects</a>
                        </li>
                        <li> <a href="component-modals.html"><i class='bx bx-radio-circle'></i>Modals</a>
                        </li>
                        <li> <a href="component-navs-tabs.html"><i class='bx bx-radio-circle'></i>Navs & Tabs</a>
                        </li>
                        <li> <a href="component-navbar.html"><i class='bx bx-radio-circle'></i>Navbar</a>
                        </li>
                        <li> <a href="component-paginations.html"><i class='bx bx-radio-circle'></i>Pagination</a>
                        </li>
                        <li> <a href="component-popovers-tooltips.html"><i class='bx bx-radio-circle'></i>Popovers & Tooltips</a>
                        </li>
                        <li> <a href="component-progress-bars.html"><i class='bx bx-radio-circle'></i>Progress</a>
                        </li>
                        <li> <a href="component-spinners.html"><i class='bx bx-radio-circle'></i>Spinners</a>
                        </li>
                        <li> <a href="component-notifications.html"><i class='bx bx-radio-circle'></i>Notifications</a>
                        </li>
                        <li> <a href="component-avtars-chips.html"><i class='bx bx-radio-circle'></i>Avatrs & Chips</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-repeat"></i>
                        </div>
                        <div class="menu-title">Content</div>
                    </a>
                    <ul>
                        <li> <a href="content-grid-system.html"><i class='bx bx-radio-circle'></i>Grid System</a>
                        </li>
                        <li> <a href="content-typography.html"><i class='bx bx-radio-circle'></i>Typography</a>
                        </li>
                        <li> <a href="content-text-utilities.html"><i class='bx bx-radio-circle'></i>Text Utilities</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                        </div>
                        <div class="menu-title">Icons</div>
                    </a>
                    <ul>
                        <li> <a href="icons-line-icons.html"><i class='bx bx-radio-circle'></i>Line Icons</a>
                        </li>
                        <li> <a href="icons-boxicons.html"><i class='bx bx-radio-circle'></i>Boxicons</a>
                        </li>
                        <li> <a href="icons-feather-icons.html"><i class='bx bx-radio-circle'></i>Feather Icons</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>