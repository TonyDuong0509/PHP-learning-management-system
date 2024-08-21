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
                        <li class="breadcrumb-item active" aria-current="page">All Courses </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image </th>
                                <th>Course Name </th>
                                <th>Instructor </th>
                                <th>Category </th>
                                <th>Price </th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($courses)): ?>
                                <?php foreach ($courses as $key => $course): ?>
                                    <tr>
                                        <td>
                                            <?php echo $key++; ?>
                                        </td>
                                        <td>
                                            <img src="/<?php echo $course->getImage(); ?>" alt="" style="width: 70px; height:50px;">
                                        </td>
                                        <td>
                                            <?php echo $course->getName(); ?>
                                        </td>
                                        <td>
                                            <?php echo $course->getInstructorName(); ?>
                                        </td>
                                        <td>
                                            <?php echo $course->getCategoryName(); ?>
                                        </td>
                                        <td>
                                            $<?php echo $course->getSellingPrice(); ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo $router->generate('admin.course.details', ['id' => $course->getId()]); ?>" class="btn btn-info"><i class="lni lni-eye"></i></a>
                                        </td>
                                        <td>
                                            <div class="form-check-danger form-check form-switch">
                                                <input class="form-check-input status-toggle large-checkbox" type="checkbox" id="flexSwitchCheckCheckedDanger" data-course-id="<?php echo $course->getId(); ?>" <?php echo $course->getStatus() ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="flexSwitchCheckCheckedDanger"> </label>
                                            </div>
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