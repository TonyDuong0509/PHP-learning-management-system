<?php require ABSPATH . 'resources/instructor/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/instructor/layout/header.php'; ?>

<?php
$router = $router;
?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Orders</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Date </th>
                                <th>Invoice</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orderItem)): ?>
                                <?php foreach ($orderItem as $key => $item): ?>
                                    <tr>
                                        <td>
                                            <?php echo $key++; ?>
                                        </td>
                                        <td>
                                            <?php echo $item->getPayment()->getOrderDate(); ?>
                                        </td>
                                        <td>
                                            <?php echo $item->getPayment()->getInvoiceNo(); ?>
                                        </td>
                                        <td>
                                            $<?php echo $item->getPayment()->getTotalAmount(); ?>
                                        </td>
                                        <td>
                                            <?php echo $item->getPayment()->getPaymentType(); ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-success"><?php echo $item->getPayment()->getStatus(); ?></span>
                                        </td>
                                        <td>
                                            <a href="<?php echo $router->generate('instructor.order.details', ['payment_id' => $item->getPayment()->getId()]); ?>" class="btn btn-info" title="Edit"><i class="lni lni-eye"></i> </a>
                                            <a href="" class="btn btn-danger" id="delete" title="delete"><i class="lni lni-download"></i> </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
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