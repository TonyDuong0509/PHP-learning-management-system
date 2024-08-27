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
                        <li class="breadcrumb-item active" aria-current="page">Instructor Add Coupon </li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Add Coupon</h5>
                <form action="<?php echo $router->generate('instructor.store.coupon'); ?>" method="POST" class="row g-3" enctype="multipart/form-data">
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Coupon Name</label>
                        <input type="text" name="coupon_name" class="form-control" id="input1">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input2" class="form-label">Coupon Discount </label>
                        <input class="form-control" name="coupon_discount" type="number">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input2" class="form-label">Courses </label>
                        <select name="course_id" class="form-select mb-3" aria-label="Default select example">
                            <option selected="">Open this select menu</option>
                            <?php if (!empty($courses)): ?>
                                <?php foreach ($courses as $course): ?>
                                    <option value="<?php echo $course->getId(); ?>">
                                        <?php echo $course->getName(); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input2" class="form-label">Coupon Validity Date </label>
                        <input class="form-control" name="coupon_validity" type="date" min="<?php echo date('Y-m-d') ?>">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </div>
                </form>
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