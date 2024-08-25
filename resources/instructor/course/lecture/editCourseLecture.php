<?php require ABSPATH . 'resources/instructor/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/instructor/layout/header.php'; ?>
<?php
$section = $section;
$router = $router;
$lecture = $lecture;
?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Lecture Course</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="ms-auto">
                        <div class="btn-group">
                            <a href="<?php echo $router->generate('add.course.lecture', ['id' => $section->getCourseId()]) ?>">Back</a>
                        </div>
                    </div>

                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Edit Lecture</h5>
                        <form action="<?php echo $router->generate('update.course.lecture'); ?>" method="POST" class="row g-3" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $lecture->getId(); ?>">
                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Lecture Title</label>
                                <input type="text" name="lecture_title" class="form-control" id="input1" value="<?php echo $lecture->getLectureTitle(); ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Video Url </label>
                                <input type="text" name="url" class="form-control" id="input1" value="<?php echo $lecture->getUrl(); ?>">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="input1" class="form-label">Lecture Content </label>
                                <textarea name="content" class="form-control"><?php echo $lecture->getContent(); ?></textarea>
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
    </div>
</div>

<?php require ABSPATH . 'resources/instructor/layout/footer.php'; ?>

</div>
<!--end wrapper-->

<?php require ABSPATH . 'resources/instructor/layout/footerScript.php'; ?>

<script src="https://cdn.tiny.cloud/1/un10p28mte1m6vqlakgep52j3s4tht5h1q4zqrrvv0iz0hlf/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#myeditorinstance',
        plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
    });
</script>

<script>
    new PerfectScrollbar(".app-container")
</script>

</body>

</html>