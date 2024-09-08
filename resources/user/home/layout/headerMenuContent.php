<div class="header-menu-content pr-150px pl-150px bg-white">
    <div class="container-fluid">
        <div class="main-menu-content">
            <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <div class="logo-box">
                        <a href="/" class="logo"><img src="<?php ABSPATH ?>/public/frontend/images/logo.png" alt="logo"></a>
                        <div class="user-btn-action">
                            <div class="search-menu-toggle icon-element icon-element-sm shadow-sm mr-2" data-toggle="tooltip" data-placement="top" title="Search">
                                <i class="la la-search"></i>
                            </div>
                            <div class="off-canvas-menu-toggle cat-menu-toggle icon-element icon-element-sm shadow-sm mr-2" data-toggle="tooltip" data-placement="top" title="Category menu">
                                <i class="la la-th-large"></i>
                            </div>
                            <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="top" title="Main menu">
                                <i class="la la-bars"></i>
                            </div>
                        </div>
                    </div>
                </div><!-- end col-lg-2 -->
                <div class="col-lg-10">
                    <div class="menu-wrapper">
                        <div class="menu-category">
                            <ul>
                                <li>
                                    <a href="#">Categories <i class="la la-angle-down fs-12"></i></a>
                                    <ul class="cat-dropdown-menu">
                                        <?php if (!empty($categories)): ?>
                                            <?php foreach ($categories as $category): ?>
                                                <li>
                                                    <a href="<?php echo $router->generate('course.category', ['id' => $category->getId(), 'slug' => $category->getSlug()]); ?>"><?php echo $category->getName(); ?> <i class="la la-angle-right"></i></a>
                                                    <ul class="sub-menu">
                                                        <?php
                                                        $category_id = $category->getId();
                                                        if (!empty($subCategories[$category_id])): ?>
                                                            <?php foreach ($subCategories[$category_id] as $subCategory): ?>
                                                                <li><a href="<?php echo $router->generate('course.subCategory', ['id' => $subCategory->getId(), 'slug' => $subCategory->getSlug()]); ?>"><?php echo $subCategory->getName(); ?></a></li>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            </ul>
                        </div><!-- end menu-category -->
                        <form method="post">
                            <div class="form-group mb-0">
                                <input class="form-control form--control pl-3" type="text" name="search" placeholder="Search for anything">
                                <span class="la la-search search-icon"></span>
                            </div>
                        </form>
                        <nav class="main-menu">
                            <ul>
                                <li>
                                    <a href="/">Home</a>
                                </li>
                                <li>
                                    <a href="/blog/posts/all">Blog </a>
                                </li>
                            </ul><!-- end ul -->
                        </nav><!-- end main-menu -->
                        <div class="shop-cart mr-4">
                            <ul>
                                <li>
                                    <p class="shop-cart-btn d-flex align-items-center">
                                        <i class="la la-shopping-cart"></i>
                                        <span class="product-count" id="cartQty">0</span>
                                    </p>
                                    <ul class="cart-dropdown-menu">
                                        <div id="miniCart">

                                        </div>
                                        <br></br>
                                        <li class="media media-card">
                                            <div class="media-body fs-16">
                                                <p class="text-black font-weight-semi-bold lh-18">Total: $<span class="cart-total" id="cartSubTotal"> </p>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="<?php echo $router->generate('mycart'); ?>" class="btn theme-btn w-100">Got to cart <i class="la la-arrow-right icon ml-1"></i></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div><!-- end shop-cart -->
                    </div><!-- end menu-wrapper -->
                </div><!-- end col-lg-10 -->
            </div><!-- end row -->
        </div>
        <style>
            .alert-container {
                position: fixed;
                top: 21%;
                right: 2%;
                z-index: 1050;
                width: 300px;
            }
        </style>
        <div id="alert-container" class="alert-container"></div>
    </div><!-- end container-fluid -->
</div>