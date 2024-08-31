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
                        <li class="breadcrumb-item active" aria-current="page">Add Blog Post</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Add Blog Post</h5>
                <form action="<?php echo $router->generate('blog.posts.store'); ?>" method="POST" class="row g-3" enctype="multipart/form-data">
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Blog Category </label>
                        <select name="blogcategory_id" class="form-select mb-3" aria-label="Default select example">
                            <option selected="">Open this select menu</option>
                            <?php if (!empty($blogCategories)): ?>
                                <?php foreach ($blogCategories as $blogCategory): ?>
                                    <option value="<?php echo $blogCategory->getId(); ?>">
                                        <?php echo $blogCategory->getCategoryName(); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Post Title</label>
                        <input type="text" name="post_title" class="form-control" id="input1">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Post Description</label>
                        <textarea name="description" class="form-control" id="myeditorinstance"></textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Post Tags</label>
                        <input type="text" name="post_tags" class="form-control" data-role="tagsinput" value="">
                    </div>

                    <div class="col-md-6">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input2" class="form-label">Post Image </label>
                        <input class="form-control" name="post_image" type="file" id="image">
                    </div>

                    <div class="col-md-6">
                        <img id="showImage" src="" alt="Admin" class="rounded-circle p-1 bg-primary" width="150">
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

<div class="overlay toggle-icon"></div>
<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<?php require ABSPATH . 'resources/admin/layout/footer.php'; ?>
</div>

<?php require ABSPATH . 'resources/admin/layout/footerScript.php'; ?>
<script src="https://cdn.tiny.cloud/1/un10p28mte1m6vqlakgep52j3s4tht5h1q4zqrrvv0iz0hlf/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#myeditorinstance',
        plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
    });
</script>

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
<script>
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
<script src="public/js/app.js"></script>

</body>

</html>