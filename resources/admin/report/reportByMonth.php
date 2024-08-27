<?php require ABSPATH . 'resources/admin/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/admin/layout/header.php'; ?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Report By Date </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                </div>
            </div>
        </div>

        <h3> Seach By Month : <?php echo $month; ?> - <?php echo $year; ?></h3>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Date </th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Invoice</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($payments)): ?>
                                <?php foreach ($payments as $key => $payment): ?>
                                    <tr>
                                        <td>
                                            <?php echo $key++; ?>
                                        </td>
                                        <td>
                                            <?php echo $payment->getOrderDate(); ?>
                                        </td>
                                        <td>
                                            <?php echo $payment->getName(); ?>
                                        </td>
                                        <td>
                                            <?php echo $payment->getEmail(); ?>
                                        </td>
                                        <td>
                                            <?php echo $payment->getInvoiceNo(); ?>
                                        </td>
                                        <td>
                                            <?php echo $payment->getTotalAmount(); ?>
                                        </td>
                                        <td>
                                            <?php echo $payment->getPaymentType(); ?>
                                        </td>
                                        <td>
                                            <?php if ($payment->getStatus() == 'pending'): ?>
                                                <span class="badge rounded-pill bg-warning"><?php echo $payment->getStatus(); ?></span>
                                            <?php else: ?>
                                                <span class="badge rounded-pill bg-success"><?php echo $payment->getStatus(); ?></span>
                                            <?php endif; ?>
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

<div class="overlay toggle-icon"></div>
<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<?php require ABSPATH . 'resources/admin/layout/footer.php'; ?>
</div>

<?php require ABSPATH . 'resources/admin/layout/footerScript.php'; ?>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>
<script src="public/js/app.js"></script>

</body>

</html>