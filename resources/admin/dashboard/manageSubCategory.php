<?php require ABSPATH . 'resources/admin/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/admin/layout/header.php'; ?>

<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">All SubCategory</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <?php if (isset($_GET['success'])) {
                        if ($_GET['success'] == 1) {
                            echo "
                                        <div class='alert alert-success'>
                                            Deleted successfully !
                                        </div>
                                    ";
                        }
                    } ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Name</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($subCategories)): ?>
                                <?php foreach ($subCategories as $subCategory) : ?>
                                    <tr>
                                        <td>
                                            <?php echo $subCategory->getId(); ?>
                                        </td>
                                        <td>
                                            <?php echo $subCategory->getCategoryName(); ?>
                                        </td>
                                        <td>
                                            <?php echo $subCategory->getName(); ?>
                                        </td>
                                        <td><?php echo $subCategory->getSlug(); ?>

                                        </td>
                                        <td>
                                            <?php echo $subCategory->getCreatedAt(); ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning" href="/admin/edit-subcategory/<?php echo $subCategory->getId(); ?>">Edit</a>
                                            <a class="btn btn-danger" href="<?php echo $router->generate('admin.destroy.subcategory', ['subCid' => $subCategory->getId()]); ?>" onclick="return confirmDelete()">Delete</a>
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
<!--app JS-->
<script src="public/js/app.js"></script>

<script type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure ? Click OK to delete.');
    }
</script>

</body>

</html>