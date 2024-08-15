<?php $router = $router; ?>
<div class="header-top pr-150px pl-150px border-bottom border-bottom-gray py-1">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="header-widget">
                    <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                        <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i class="la la-phone mr-1"></i><a href="tel:00123456789"> (00) 123 456 789</a></li>
                        <li class="d-flex align-items-center"><i class="la la-envelope-o mr-1"></i><a href="mailto:contact@aduca.com"> contact@aduca.com</a></li>
                    </ul>
                </div><!-- end header-widget -->
            </div><!-- end col-lg-6 -->
            <div class="col-lg-6">

                <?php if (isset($_SESSION['emailUser']) && !empty($_SESSION['emailUser'])) : ?>
                    <div class="header-widget d-flex flex-wrap align-items-center justify-content-end">
                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14 border-left border-left-gray pl-3 ml-3">
                            <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i class="la la-sign-in mr-1"></i><a href="#">Dashboard</a></li>
                            <li class="d-flex align-items-center"><i class="la la-user mr-1"></i><a href="<?php echo $router->generate('logout') ?>">Logout</a></li>
                        </ul>
                    </div><!-- end header-widget -->

                <?php elseif (!isset($_SESSION['emailUser']) && empty($_SESSION['emailUser'])) : ?>

                    <div class="header-widget d-flex flex-wrap align-items-center justify-content-end">
                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14 border-left border-left-gray pl-3 ml-3">
                            <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i class="la la-sign-in mr-1"></i><a href="<?php echo $router->generate('login') ?>"> Login</a></li>
                            <li class="d-flex align-items-center"><i class="la la-user mr-1"></i><a href="<?php echo $router->generate('register') ?>"> Register</a></li>
                        </ul>
                    </div><!-- end header-widget -->

                <?php endif; ?>
            </div><!-- end col-lg-6 -->
        </div><!-- end row -->
    </div><!-- end container-fluid -->
</div><!-- end header-top -->