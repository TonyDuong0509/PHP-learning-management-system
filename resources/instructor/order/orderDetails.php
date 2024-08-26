<?php require ABSPATH . 'resources/instructor/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/instructor/layout/header.php'; ?>

<?php
$router = $router;
?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Order Details</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="card">

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <strong><?php echo $payment->getName(); ?></strong>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <strong><?php echo $payment->getEmail(); ?></strong>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Cash Delivery</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <strong><?php echo $payment->getCashDelivery(); ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Total Amount </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <strong>$<?php echo $payment->getTotalAmount(); ?></strong>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Payment Type </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <strong><?php echo $payment->getPaymentType(); ?></strong>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Invoice Number </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <strong><?php echo $payment->getInvoiceNo(); ?></strong>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Order Date </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <strong><?php echo $payment->getOrderDate(); ?></strong>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Status</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php if ($payment->getStatus() == 'pending'): ?>
                                            <a href="<?php echo $router->generate('pending-confirm-instructor', ['id' => $payment->getId()]); ?>" class="btn btn-block btn-primary" id="confirm">Confirm Order</a>
                                        <?php elseif ($payment->getStatus() == 'confirm'): ?>
                                            <button disabled class="btn btn-block btn-success">Confirmed</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 ms-3">
                                <div class="table-responsive">
                                    <table class="table" style="font-weight: 600;">
                                        <tbody>
                                            <tr>
                                                <td class="col-md-1">
                                                    <label>Image</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <label>Course Name</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <label>Category </label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label>Instructor</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <label>Price</label>
                                                </td>
                                            </tr>
                                            <?php $totalPrice = 0; ?>
                                            <?php if (!empty($orderItem)): ?>
                                                <?php foreach ($orderItem as $item): ?>
                                                    <tr>
                                                        <td class="col-md-1">
                                                            <label><img src="/<?php echo $item->getCourse()->getImage(); ?>" alt="" style="width: 50px; height:50px;"> </label>
                                                        </td>

                                                        <td class="col-md-2">
                                                            <label><?php echo $item->getCourse()->getName(); ?></label>
                                                        </td>

                                                        <td class="col-md-2">
                                                            <label><?php echo $item->getCourse()->getCategoryName(); ?></label>
                                                        </td>

                                                        <td class="col-md-2">
                                                            <label><?php echo $item->getCourse()->getInstructorName(); ?></label>
                                                        </td>

                                                        <td class="col-md-2">
                                                            <label>$<?php echo $item->getPrice(); ?></label>
                                                        </td>
                                                    </tr>
                                                    <?php $totalPrice += $item->getPrice(); ?>
                                                <?php endforeach ?>
                                            <?php endif; ?>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td class="col-md-3">
                                                    <strong>Total Price : $<?php echo $totalPrice; ?></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require ABSPATH . 'resources/instructor/layout/footer.php'; ?>

</div>

<?php require ABSPATH . 'resources/instructor/layout/footerScript.php'; ?>
<script src="<?php ABSPATH ?>/instructor/public/js/app.js"></script>
<script>
    new PerfectScrollbar(".app-container")
</script>
</body>

</html>