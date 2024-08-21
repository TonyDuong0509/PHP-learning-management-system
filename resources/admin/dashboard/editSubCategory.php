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
                        <li class="breadcrumb-item active" aria-current="page">Edit SubCategory</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Edit SubCategory</h5>
                <?php if (isset($_GET['error'])) {
                    if ($_GET['error'] == 1) {
                        echo "
                                    <div class='alert alert-danger'>
                                        Upload image failure, please try again !
                                    </div>
                                ";
                    }
                    if ($_GET['error'] == 2) {
                        echo "
                                    <div class='alert alert-danger'>
                                        Image must be JPG, JPEG, PNG please !
                                    </div>
                                ";
                    }
                }
                ?>
                <?php if (isset($_GET['success'])) {
                    if ($_GET['success'] == 1) {
                        echo "
                                    <div class='alert alert-success'>
                                        Updated SubCategory successfully !
                                    </div>
                                ";
                    }
                }
                ?>
                <?php $subCategory = $subCategory; ?>
                <form method="POST" action="<?php echo $router->generate('admin.update.subcategory'); ?>" class="row g-3" enctype="multipart/form-data">
                    <input type="hidden" name="subCid" value="<?php echo $subCategory->getId(); ?>">
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">SubCategory Name</label>
                        <input type="text" name="subCategory_name" value="<?php echo $subCategory->getName(); ?>" class="form-control" id="input1" required>
                    </div>

                    <div class="col-md-6">
                    </div>

                    <div class="col-md-6">
                        <select class="form-control" name="category_id">
                            <option>Select Menu</option>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $category) : ?>
                                    <option <?php echo ($category->getId() == $subCategory->getCategoryId()) ? 'selected' : ''; ?> value="<?php echo $category->getId(); ?>">
                                        <?php echo $category->getName(); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <a href="/admin/manage-subcategory" class="btn btn-warning">Back Manage Category</a>
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
<!--start overlay-->
<div class="overlay toggle-icon"></div>
<!--end overlay-->
<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<!--End Back To Top Button-->
<?php require ABSPATH . 'resources/admin/layout/footer.php'; ?>
</div>
<!--end wrapper-->


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