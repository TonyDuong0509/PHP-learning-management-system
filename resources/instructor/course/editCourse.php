<?php require ABSPATH . 'resources/instructor/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/instructor/layout/header.php'; ?>
<?php $course = $course; ?>

<div class="page-wrapper">

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Course</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Edit Course</h5>
                <?php if (isset($_GET['success'])) {
                    if ($_GET['success'] == 1) {
                        echo "
                                    <div class='alert alert-success'>
                                        Updated course successfully !
                                    </div>
                                    ";
                    }
                    if ($_GET['success'] == 2) {
                        echo "
                                    <div class='alert alert-success'>
                                        Updated course image successfully !
                                    </div>
                                    ";
                    }
                    if ($_GET['success'] == 3) {
                        echo "
                                    <div class='alert alert-success'>
                                        Updated course video successfully !
                                    </div>
                                    ";
                    }
                    if ($_GET['success'] == 4) {
                        echo "
                                    <div class='alert alert-success'>
                                        Updated course goals successfully !
                                    </div>
                                    ";
                    }
                }
                ?>

                <form action="?c=course&a=updateCourse" method="POST" class="row g-3" enctype="multipart/form-data">

                    <input type="hidden" name="course_id" value="<?php echo $course->getId(); ?>">

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Name</label>
                        <input type="text" name="course_name" class="form-control" id="input1" value="<?php echo $course->getName(); ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Title </label>
                        <input type="text" name="course_title" class="form-control" id="input1" value="<?php echo $course->getTitle(); ?>">
                    </div>


                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Category </label>
                        <select name="category_id" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Select Menu</option>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option <?php echo ($course->getCategoryId() == $category->getId()) ? 'selected' : '' ?>
                                        value="<?php echo $category->getId(); ?>">
                                        <?php echo $category->getName(); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Subcategory </label>
                        <select name="subcategory_id" class="form-select mb-3" aria-label="Default select example" require>
                            <?php if (!empty($subcategories)): ?>
                                <?php foreach ($subcategories as $subcategory): ?>
                                    <option <?php echo ($course->getSubcategoryId() == $subcategory->getId()) ? 'selected' : '' ?> value="<?php echo $subcategory->getId(); ?>"><?php echo $subcategory->getName(); ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Certificate Available </label>
                        <select name="certificate" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Select Menu</option>
                            <option value="Yes" <?php echo $course->getCertificate() == 'Yes' ? 'selected' : '' ?>>Yes</option>
                            <option value="No" <?php echo $course->getCertificate() == 'No' ? 'selected' : '' ?>>No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Label </label>
                        <select name="label" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Select Menu</option>
                            <option value="Begginer" <?php echo $course->getLabel() == 'Beginner' ? 'selected' : ''; ?>>Beginner</option>
                            <option value="Middle" <?php echo $course->getLabel() == 'Middle' ? 'selected' : ''; ?>>Middle</option>
                            <option value="Advance" <?php echo $course->getLabel() == 'Advance' ? 'selected' : ''; ?>>Advance</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Course Type</label>
                        <select name="type_id" class="form-select mb-3" aria-label="Default select example" required>
                            <option selected="" disabled>Select Menu</option>
                            <?php if (!empty($types)): ?>
                                <?php foreach ($types as $type): ?>
                                    <option <?php echo ($type->getId() == $course->getTypeId()) ? 'selected' : ''; ?> value="<?php echo $type->getId(); ?>"><?php echo $type->getTitle(); ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Course Price </label>
                        <input type="text" name="selling_price" class="form-control" id="input1" value="<?php echo $course->getSellingPrice(); ?>">
                    </div>


                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Discount Price </label>
                        <input type="text" name="discount_price" class="form-control" id="input1" value="<?php echo $course->getDiscountPrice(); ?>">
                    </div>


                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Duration </label>
                        <input type="text" name="duration" class="form-control" id="input1" value="<?php echo $course->getDuration(); ?>">
                    </div>


                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Resources </label>
                        <input type="text" name="resources" class="form-control" id="input1" value="<?php echo $course->getResources(); ?>">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Course Prerequisites </label>
                        <textarea name="prerequisites" class="form-control" id="input11" placeholder="Prerequisites ..." rows="5"><?php echo $course->getPrerequisuites(); ?></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Course Description </label>
                        <textarea name="description" class="form-control" id="myeditorinstance"><?php echo $course->getDescription(); ?></textarea>
                    </div>

                    <hr>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="bestseller" <?php echo $course->getBestseller() == 1 ? 'checked' : ''; ?> value="1>" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">BestSeller</label>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="featured" <?php echo $course->getFeatured() == 1 ? 'checked' : ''; ?> value="1" id="flexCheckDefault2">
                                <label class="form-check-label" for="flexCheckDefault2">Featured</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="highestrated" <?php echo $course->getHighestrated() == 1 ? 'checked' : ''; ?> value="1" id="flexCheckDefault1">

                                <label class="form-check-label" for="flexCheckDefault1">Highest Rated</label>
                            </div>
                        </div>

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

    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <form action="?c=course&a=updateCourseImage" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="course_id" value="<?php echo $course->getId(); ?>">
                    <input type="hidden" name="old_img" value="<?php echo $course->getImage(); ?>">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="input2" class="form-label">Course Image </label>
                            <input class="form-control" name="course_image" type="file" id="image">
                        </div>

                        <div class="col-md-6">
                            <img id="showImage" src="../../<?php echo $course->getImage(); ?>" alt="" class="rounded-circle p-1 bg-primary" width="150">
                        </div>
                    </div>
                    <br><br>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <form action="?c=course&a=updateCourseVideo" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="course_id" value="<?php echo $course->getId(); ?>">
                    <input type="hidden" name="old_video" value="<?php echo $course->getVideo(); ?>">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="input2" class="form-label">Course Intro Video</label>
                            <input type="file" name="video" class="form-control" accept="video/mp4, video/webm">
                        </div>
                        <div class="col-md-6">
                            <video width="300" height="130" controls>
                                <source src="../../<?php echo $course->getVideo(); ?>" type="video/mp4">
                            </video>
                        </div>
                    </div>
                    <br><br>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <form action="?c=course&a=updateCourseGoals" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="course_id" value="<?php echo $course->getId(); ?>">
                    <?php if (isset($courseGoals)): ?>
                        <?php foreach ($courseGoals as $goal): ?>
                            <div class="row add_item">
                                <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                    <div class="container mt-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="goals" class="form-label"> Goals </label>
                                                    <input type="text" name="course_goals[]" id="goals" class="form-control" value="<?php echo $goal->getGoalName(); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6" style="padding-top: 30px;">
                                                <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
                                                <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <br><br>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--========== Start of add multiple class with ajax ==============-->
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                <div class="container mt-2">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="goals">Goals</label>
                            <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Goals  ">
                        </div>
                        <div class="form-group col-md-6" style="padding-top: 20px">
                            <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                            <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                        </div>
                    </div>
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

<script src="https://cdn.tiny.cloud/1/un10p28mte1m6vqlakgep52j3s4tht5h1q4zqrrvv0iz0hlf/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#myeditorinstance',
        plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var counter = 0;
        $(document).on("click", ".addeventmore", function() {
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click", ".removeeventmore", function(event) {
            $(this).closest("#whole_extra_item_delete").remove();
            counter -= 1
        });
    });
</script>

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

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    type: "GET",
                    url: "/instructor/?c=course&a=subCategoryAjax&cid=" + category_id,
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('select[name="subcategory_id"]').html('');
                        var d = $('select[name="subcategory_id"]').empty();

                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

<script>
    new PerfectScrollbar(".app-container")
</script>
</body>

</html>