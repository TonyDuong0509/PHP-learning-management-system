<?php require ABSPATH . 'resources/admin/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/admin/layout/header.php'; ?>

<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">All Category</h6>
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
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($categories)): ?>
                                <?php foreach ($categories as $category) : ?>
                                    <tr>
                                        <td>
                                            <?php echo $category->getId(); ?>
                                        </td>
                                        <td class="text-center">
                                            <img src="<?php echo $category->getImage() ?? '../public/upload/no_image.png'; ?>" alt="Instructor Avatar" width="60px">
                                        </td>
                                        <td>
                                            <?php echo $category->getName(); ?>
                                        </td>
                                        <td><?php echo $category->getSlug(); ?>

                                        </td>
                                        <td>
                                            <?php echo $category->getCreatedAt(); ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning" href="?c=dashboard&a=edit&cid=<?php echo $category->getId(); ?>">Edit</a>
                                            <a class="btn btn-danger" href="?c=dashboard&a=destroy&cid=<?php echo $category->getId(); ?>" onclick="return confirmDelete()">Delete</a>
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