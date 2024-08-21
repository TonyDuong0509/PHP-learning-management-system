<?php require ABSPATH . 'resources/user/layout/header.php'; ?>

<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">Shopping Cart</h2>
            </div>
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="index.html">Home</a></li>
                <li>Pages</li>
                <li>Shopping Cart</li>
            </ul>
        </div>
    </div>
</section>

<section class="cart-area section-padding">
    <?php if (!empty($cartTotals)): ?>
        <div class="container">
            <div class="table-responsive">
                <?php if (isset($_GET['error'])) {
                    if ($_GET['error'] == 1) {
                        echo "
                            <div class='alert alert-danger'>
                                You have to at least 1 course to checkout.
                            </div>
                            ";
                    }
                    if ($_GET['error'] == 2) {
                        echo "
                            <div class='alert alert-danger'>
                                You have to login before checkouting, click <a href='/login'>here</a> to login
                            </div>
                            ";
                    }
                }
                ?>
                <table class="table generic-table">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Course Details</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="cartPage">

                    </tbody>
                </table>
                <div class="d-flex flex-wrap align-items-center justify-content-between pt-4">
                    <?php if (isset($_SESSION['coupon']) || !empty($_SESSION['coupon'])): ?>

                    <?php else: ?>
                        <form action="#">
                            <div class="input-group mb-2" id="couponField">
                                <input class="form-control form--control pl-3" type="text" id="coupon_name" placeholder="Coupon code">
                                <div class="input-group-append">
                                    <a class="btn theme-btn" type="submit" onclick="applyCoupon()" style="color: white">Apply Code</a>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4 ml-auto">
                <div class="bg-gray p-4 rounded-rounded mt-40px" id="couponCalField">
                </div>
                <a href="<?php echo $router->generate('checkout'); ?>" class="btn theme-btn w-100">Checkout <i class="la la-arrow-right icon ml-1"></i></a>
            </div>
        </div>

    <?php else: ?>

        <p class="text-center" style="color:red; font-size: 28px; font-weight: bold;">Cart is empty, please add course to cart, thank you !</p>

    <?php endif; ?>
</section>

<?php require ABSPATH . 'resources/user/layout/footer.php'; ?>

<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
</div>

<?php require ABSPATH . 'resources/user/layout/footerScript.php'; ?>

</body>

</html>