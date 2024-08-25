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
                        <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Add Category</h5>
                <form method="POST" action="<?php echo $router->generate('admin.store.category'); ?>" class="row g-3" enctype="multipart/form-data">
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Category Name</label>
                        <input type="text" name="category_name" class="form-control" id="input1" required>
                    </div>

                    <div class="col-md-6">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input2" class="form-label">Category Image</label>
                        <input class="form-control" name="image" type="file" id="image" required>
                    </div>

                    <div class="col-md-6">
                        <img id="showImage" src="/upload/no_image.png" alt="Category image" class="rounded-circle p-1 bg-primary" width="80">
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
<!--end page wrapper -->
<!--start overlay-->
<div class="overlay toggle-icon"></div>
<!--end overlay-->
<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<!--End Back To Top Button-->
<?php require ABSPATH . 'resources/admin/layout/header.php'; ?>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

</body>

</html>