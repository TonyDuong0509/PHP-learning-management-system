<?php require ABSPATH . 'resources/instructor/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/instructor/layout/header.php'; ?>

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
                    <a href="<?php echo $router->generate('instructor.add.coupon'); ?>" class="btn btn-primary px-5">Add Coupon </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Coupon Name </th>
                                <th>Coupon Discount</th>
                                <th>Coupon Status</th>
                                <th>Active</th>
                                <th>Course Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($coupons)): ?>
                                <?php foreach ($coupons as $key => $coupon): ?>
                                    <tr>
                                        <td>
                                            <?php echo $key++; ?>
                                        </td>
                                        <td>
                                            <?php echo $coupon->getCouponName(); ?>
                                        </td>
                                        <td>
                                            <?php echo $coupon->getCouponDiscount(); ?>%
                                        </td>
                                        <td>
                                            <?php if ($coupon->getCouponValidity() >= date('Y-m-d')): ?>
                                                <span class="badge bg-success">Valid</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Invalid</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($coupon->getStatus() == 1): ?>
                                                <span class="badge bg-success">Actived</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo $coupon->getCourseName(); ?>
                                        </td>
                                        <td>
                                            <?php if ($coupon->getStatus() == 0): ?>
                                                <button disabled class="btn btn-info px-5">Edit </button>
                                                <button disabled class="btn btn-danger px-5" id="delete">Delete </button>
                                            <?php else: ?>
                                                <a href="/instructor/edit/coupon/<?php echo $coupon->getId(); ?>" class="btn btn-info px-5">Edit </a>
                                                <a href="/instructor/delete/coupon/<?php echo $coupon->getId(); ?>" class="btn btn-danger px-5" id="delete">Delete </a>
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

<?php require ABSPATH . 'resources/instructor/layout/footer.php'; ?>

</div>

<?php require ABSPATH . 'resources/instructor/layout/footerScript.php'; ?>
<script src="<?php ABSPATH ?>/instructor/public/js/app.js"></script>
<script>
    new PerfectScrollbar(".app-container")
</script>
<script type="text/javascript">
    function confirmDelete() {
        return confirm("Are you sure? Click ok to delete !");
    }
</script>
</body>

</html>