<?php require ABSPATH . 'resources/admin/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/admin/layout/header.php'; ?>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Coupon</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="/admin/add/coupon" class="btn btn-primary px-5">Add Coupon </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <?php if (isset($_GET['success'])) {
                        if ($_GET['success'] == 1) {
                            echo "
                                <div class='alert alert-success'>
                                    Added Coupon successfully
                                </div>
                            ";
                        }
                        if ($_GET['success'] == 2) {
                            echo "
                                <div class='alert alert-success'>
                                    Deleted Coupon successfully
                                </div>
                            ";
                        }
                    }
                    ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Coupon Name </th>
                                <th>Coupon Discount</th>
                                <th>Coupon Validity</th>
                                <th>Coupon Status </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($coupons)): ?>
                                <?php foreach ($coupons as $key => $coupon): ?>
                                    <tr>
                                        <td>
                                            <?php echo $key++; ?>
                                        </td>
                                        <td>
                                            <?php echo $coupon->getCouponName(); ?>
                                        </td>
                                        <td>
                                            <?php echo $coupon->getCouponDiscount(); ?>%</td>
                                        <td>
                                            <?php echo $coupon->getCouponValidity(); ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($coupon->getStatus() == 1): ?>
                                                <span class="badge bg-success">Valid</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Invalid</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="/admin/edit/coupon/<?php echo $coupon->getId(); ?>" class="btn btn-info px-5">Edit </a>
                                            <a href="/admin/destroy/coupon/<?php echo $coupon->getId(); ?>" class=" btn btn-danger px-5" onclick="return confirmDelete()">Delete </a>
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