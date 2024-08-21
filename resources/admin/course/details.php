<?php require ABSPATH . 'resources/admin/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/admin/layout/header.php'; ?>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Course Details </div>

            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="/<?php echo $course->getImage(); ?>" class="rounded-circle p-1 border" width="90" height="90" alt="...">
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mt-0"><?php echo $course->getName(); ?></h5>
                            <p class="mb-0"><?php echo $course->getTitle(); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td><strong>Category: </strong></td>
                                            <td><?php echo $course->getCategoryName(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>SubCategory: </strong></td>
                                            <td><?php echo $course->getSubCategoryName(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Instructor: </strong></td>
                                            <td><?php echo $course->getInstructorName(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Label: </strong></td>
                                            <td><?php echo $course->getLabel(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Duration: </strong></td>
                                            <td><?php echo $course->getDuration(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Video :</strong> </td>
                                            <td>
                                                <video width="300" height="200" controls>
                                                    <source src="<?php echo $course->getVideo(); ?>" type="video/mp4">
                                                </video>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td><strong>Resources: </strong></td>
                                            <td><?php echo $course->getResources(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Certificate: </strong></td>
                                            <td><?php echo $course->getCertificate(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Selling Price :</strong> </td>
                                            <td> $<?php echo $course->getSellingPrice(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Discount Price :</strong> </td>
                                            <td> $<?php echo $course->getDiscountPrice(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status :</strong> </td>
                                            <td>
                                                <?php if ($course->getStatus() == 1): ?>
                                                    <span class="badge bg-success">Active</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Inactive</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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

</body>

</html>