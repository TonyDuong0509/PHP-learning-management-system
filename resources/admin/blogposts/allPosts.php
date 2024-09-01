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
                        <li class="breadcrumb-item active" aria-current="page">All Blog Post</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="<?php echo $router->generate('blog.posts.add'); ?>" class="btn btn-primary px-5">Add Blog Post </a>
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
                                <th>Post Title </th>
                                <th>Blog Category </th>
                                <th>Blog Image </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($blogPosts)): ?>
                                <?php foreach ($blogPosts as $key => $post): ?>
                                    <tr>
                                        <td>
                                            <?php echo $key++; ?>
                                        </td>
                                        <td>
                                            <?php echo $post->getPostTitle(); ?>
                                        </td>
                                        <td>
                                            <?php echo $post->getBlogCategory()['category_name']; ?>
                                        </td>
                                        <td> <img src="/<?php echo $post->getPostImage() ?? 'public/upload/no_image.png'; ?>" alt="Posts Image" style="width: 90px; height:60px;"> </td>
                                        <td>
                                            <a href="/edit/blog/posts/<?php echo $post->getId(); ?>" class="btn btn-info px-5">Edit </a>
                                            <a href="/delete/blog/posts/<?php echo $post->getId(); ?>" class="btn btn-danger px-5" onclick="return confirmDelete()">Delete </a>
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