<?php require ABSPATH . 'resources/instructor/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/instructor/layout/header.php'; ?>

<?php
$router = $router;
?>

<div class="page-wrapper">

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Course</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="<?php echo $router->generate('add.course'); ?>" class="btn btn-primary px-5">Add Course</a>
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
                                                Added course successfully !
                                            </div>
                                        ";
                        }
                        if ($_GET['success'] == 2) {
                            echo "
                                            <div class='alert alert-success'>
                                                Deleted successfully !
                                            </div>
                                        ";
                        }
                    }
                    ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Course Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($courses)): ?>
                                <?php foreach ($courses as $course): ?>
                                    <tr>
                                        <td>
                                            <?php echo $course->getId(); ?>
                                        </td>
                                        <td>
                                            <img src="<?php echo $course->getImage(); ?>" alt="<?php echo $course->getName(); ?>" style="width: 70px">
                                        </td>
                                        <td>
                                            <?php echo $course->getName(); ?>
                                        </td>
                                        <td>
                                            <?php echo $course->getCategoryName(); ?>
                                        </td>
                                        <td>
                                            <?php echo $course->getSellingPrice(); ?>
                                        </td>
                                        <td>
                                            <?php echo $course->getDiscountPrice(); ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo $router->generate('edit.course', ['id' => $course->getId()]) ?>" class="btn btn-info" title="Edit"><i class="lni lni-eraser"></i> </a>
                                            <a href="<?php echo $router->generate('delete.course', ['id' => $course->getId()]); ?>" onclick="return confirmDelete()" class="btn btn-danger" title="delete"><i class="lni lni-trash"></i> </a>
                                            <a href="<?php echo $router->generate('add.course.lecture', ['id' => $course->getId()]) ?>" class="btn btn-warning" title="Lecture"><i class="lni lni-list"></i> </a>
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
<!--end page wrapper -->

<?php require ABSPATH . 'resources/instructor/layout/footer.php'; ?>

</div>
<!--end wrapper-->

<?php require ABSPATH . 'resources/instructor/layout/footerScript.php'; ?>
<!--app JS-->
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