<?php require ABSPATH . 'resources/user/layout/header.php'; ?>

<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">Checkout</h2>
            </div>
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="index.html">Home</a></li>
                <li>Pages</li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>
</section>

<section class="cart-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-22 pb-3">Billing Details</h3>
                        <div class="divider"><span></span></div>
                        <form method="POST" action="<?php echo $router->generate('payment'); ?>" class="row" enctype="multipart/form-data">
                            <div class="input-box col-lg-6">
                                <label class="label-text">Full Name</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="name" value="<?php echo $user->getName(); ?>">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-6">
                                <label class="label-text">Email</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="email" name="email" value="<?php echo $user->getEmail(); ?>">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                    </div>
                </div>
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-22 pb-3">Select Payment Method</h3>
                        <div class="divider"><span></span></div>
                        <div class="payment-option-wrap">
                            <div class="payment-tab is-active">
                                <div class="payment-tab-toggle">
                                    <input checked="" id="bankTransfer" name="cash_delivery" type="radio" value="handcash">
                                    <label for="bankTransfer">Direct Payment</label>
                                </div>

                                <div class="payment-tab-toggle">
                                    <input checked="" id="bankTransfer" name="cash_delivery" type="radio" value="stripe">
                                    <label for="bankTransfer">Stripe Payment</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-22 pb-3">Order Details</h3>
                        <div class="divider"><span></span></div>
                        <div class="order-details-lists">
                            <?php if (!empty($carts)): ?>
                                <?php foreach ($carts as $cart): ?>

                                    <input type="hidden" name="slug[]" value="<?php echo $cart['options']['slug']; ?>">
                                    <input type="hidden" name="course_id[]" value="<?php echo $cart['course_id']; ?>">
                                    <input type="hidden" name="course_name[]" value="<?php echo $cart['name']; ?>">
                                    <input type="hidden" name="price[]" value="<?php echo $cart['price']; ?>">
                                    <input type="hidden" name="instructorId[]" value="<?php echo $cart['options']['instructorId']; ?>">

                                    <div class="media media-card border-bottom border-bottom-gray pb-3 mb-3">
                                        <a href="/course-details/<?php echo $cart['course_id']; ?>/<?php echo $cart['options']['slug']; ?>" class="media-img">
                                            <img src="/<?php echo $cart['options']['image'] ?? '/public/upload/no_image.png'; ?>" alt="Cart image">
                                        </a>
                                        <div class="media-body">
                                            <h5 class="fs-15 pb-2"><a href="/course-details/<?php echo $cart['course_id']; ?>/<?php echo $cart['options']['slug']; ?>"><?php echo $cart['name']; ?></a></h5>
                                            <p class="text-black font-weight-semi-bold lh-18">$<?php echo $cart['price']; ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <a href="/mycart" class="btn-text"><i style="color: red;" class="la la-edit mr-1"></i>Edit</a>
                    </div>
                </div>
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-22 pb-3">Order Summary</h3>
                        <div class="divider"><span></span></div>
                        <?php if (isset($_SESSION['coupon']) || !empty($_SESSION['coupon'])): ?>
                            <ul class="generic-list-item generic-list-item-flash fs-15">
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="text-black">SubTotal:</span>
                                    <span>
                                        $<?php echo $cartTotal; ?>
                                    </span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="text-black">Coupon Name:</span>
                                    <span>
                                        <?php echo $_SESSION['coupon']['coupon_name']; ?>
                                    </span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="text-black">Coupon Discount:</span>
                                    <span>
                                        <?php echo $_SESSION['coupon']['coupon_discount']; ?>
                                    </span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                    <span class="text-black">Total:</span>
                                    <span>
                                        $<?php echo $_SESSION['coupon']['total_amount']; ?>
                                    </span>
                                </li>
                            </ul>

                            <input type="hidden" name="total" value="<?php echo $cartTotal; ?>">

                        <?php else: ?>
                            <ul class="generic-list-item generic-list-item-flash fs-15">
                                <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                    <span class="text-black">Total:</span>
                                    <span>$<?php echo $cartTotal; ?></span>
                                </li>

                                <input type="hidden" name="total" value="<?php echo $cartTotal; ?>">

                            </ul>
                        <?php endif; ?>
                        <div class="btn-box border-top border-top-gray pt-3">
                            <p class="fs-14 lh-22 mb-2">Aduca is required by law to collect applicable transaction taxes for purchases made in certain tax jurisdictions.</p>
                            <p class="fs-14 lh-22 mb-3">By completing your purchase you agree to these <a href="#" class="text-color hover-underline">Terms of Service.</a></p>
                            <button type="submit" class="btn theme-btn w-100">Proceed <i class="la la-arrow-right icon ml-1"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</section>

<?php require ABSPATH . 'resources/user/layout/footer.php'; ?>

<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
</div>

<?php require ABSPATH . 'resources/user/layout/footerScript.php'; ?>

</body>

</html>