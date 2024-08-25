<?php require ABSPATH . 'resources/instructor/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/instructor/layout/header.php'; ?>
<?php
$course = $course;
$router = $router;
?>

<div class="page-wrapper">

    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="/<?php echo $course->getImage(); ?>" class="rounded-circle p-1 border" width="90" height="90" alt="...">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mt-0"><?php echo $course->getName(); ?></h5>
                                <p class="mb-0"><?php echo $course->getTitle(); ?></p>
                            </div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Section</button>
                        </div>
                    </div>
                </div>

                <?php if (!empty($section)): ?>
                    <?php foreach ($section as $key => $item): ?>
                        <div class="container">
                            <div class="main-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body p-4 d-flex justify-content-between">
                                                <h6><?php echo $item->getSectionTitle(); ?></h6>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <form action="<?php echo $router->generate('delete.course.section', ['id' => $item->getId()]); ?>" method="POST">
                                                        <button type="submit" onclick="return confirmDelete()" class="btn btn-danger px-2 ms-auto">
                                                            Delete Section
                                                        </button> &nbsp;
                                                    </form>
                                                    <a class="btn btn-primary" onclick="addLectureDiv(<?php echo $course->getId(); ?>, <?php echo $item->getId(); ?>, 'lectureContainer<?php echo $key; ?>')" id="addLectureBtn($key)"> Add Lecture </a>
                                                </div>
                                            </div>

                                            <div class="courseHide" id="lectureContainer<?php echo $key; ?>">
                                                <div class="container">
                                                    <?php $iteration = 1; ?>
                                                    <?php foreach ($item->getLectures() as $lecture): ?>
                                                        <div class="lectureDiv mb-3 d-flex align-items-center justify-content-between">
                                                            <div>
                                                                <?php echo "<strong>{$iteration}. {$lecture->getLectureTitle()}</strong>"; ?>
                                                                <?php $iteration++; ?>
                                                            </div>
                                                            <div class="btn-group">
                                                                <a href="<?php echo $router->generate('edit.course.lecture', ['id' => $item->getId()]); ?>" class="btn btn-sm btn-primary">Edit</a> &nbsp;
                                                                <form action="<?php echo $router->generate('delete.course.lecture', ['id' => $item->getId()]); ?>" method="POST">
                                                                    <button type="submit" onclick="return confirmDelete()" class="btn btn-sm btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Section </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="<?php echo $router->generate('store.course.section'); ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo $course->getId(); ?>">
                        <div class="form-group mb-3">
                            <label for="input1" class="form-label">Course Section</label>
                            <input type="text" name="section_title" class="form-control" id="input1">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!--end page wrapper -->

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

<script>
    function addLectureDiv(courseId, sectionId, containerId) {
        const lectureContainer = document.getElementById(containerId);
        const newLectureDiv = document.createElement('div');
        newLectureDiv.classList.add('lectureDiv', 'mb-3');
        newLectureDiv.innerHTML = `
                 <div class="container">
                    <h6>Lecture Title </h6>
                    <input type="text" class="form-control" placeholder="Enter Lecture Title">
                    <h6>Content</h6>
                    <textarea class="form-control mt-2" placeholder="Enter Lecture Content"  ></textarea>

                    <h6 class="mt-3">Add Video Url</h6>
                    <input type="text" name="url" class="form-control" placeholder="Add URL">

                    <button class="btn btn-primary mt-3" onclick="saveLecture('${courseId}', '${sectionId}', '${containerId}')" >Save Lecture</button>
                    <button class="btn btn-secondary mt-3" onclick="hideLectureContainer('${containerId}')">Cancel</button>
                 </div> 
            `;
        lectureContainer.appendChild(newLectureDiv);
    };

    function hideLectureContainer(containerId) {
        const lectureContainer = document.getElementById(containerId);
        lectureContainer.style.display = 'none';
        location.reload();
    };
</script>

<script>
    function saveLecture(courseId, sectionId, containerId) {
        const lectureContainer = document.getElementById(containerId);
        const lectureTitle = lectureContainer.querySelector('input[type="text"]').value;
        const lectureContent = lectureContainer.querySelector('textarea').value;
        const lectureUrl = lectureContainer.querySelector('input[name="url"]').value;

        fetch('/instructor/store-course-lecture', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    course_id: courseId,
                    section_id: sectionId,
                    lecture_title: lectureTitle,
                    lecture_url: lectureUrl,
                    content: lectureContent,
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    lectureContainer.style.display = 'none';
                    location.reload();
                }
            })
            .catch(error => {
                console.error(error);
            });
    };
</script>

<script type="text/javascript">
    function confirmDelete() {
        return confirm("Are you sure? Click ok to delete !");
    }
</script>

</body>

</html>