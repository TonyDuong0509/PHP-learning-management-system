<?php require ABSPATH . 'resources/user/dashboard/layout/header.php'; ?>

<section class="dashboard-area">
    <div class="off-canvas-menu dashboard-off-canvas-menu off--canvas-menu custom-scrollbar-styled pt-20px">

        <?php require ABSPATH . 'resources/user/dashboard/layout/sidebar.php'; ?>

    </div>
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="section-block mb-5"></div>
            <div class="dashboard-heading mb-5">
                <h3 class="fs-22 font-weight-semi-bold">My Courses</h3>
            </div>
            <div class="dashboard-cards mb-5">

                <?php if (!empty($myCourse)): ?>
                    <?php foreach ($myCourse as $item): ?>
                        <div class="card card-item card-item-list-layout">
                            <div class="card-image">
                                <a href="course-details.html" class="d-block">
                                    <img class="card-img-top" src="/<?php echo $item->getCourse()->getImage(); ?>" alt="Card image cap">
                                </a>
                            </div>
                            <div class="card-body">
                                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3"><?php echo $item->getCourse()->getLabel(); ?></h6>
                                <h5 class="card-title"><a href="<?php echo $router->generate('course.view', ['course_id' => $item->getCourseId()]); ?>"><?php echo $item->getCourse()->getName(); ?></a></h5>
                                <p class="card-text"><a href="teacher-detail.html"><?php echo $item->getCourse()->getInstructorName(); ?></a></p>
                                <div class="rating-wrap d-flex align-items-center py-2">
                                    <div class="review-stars">
                                        <span class="rating-number">4.4</span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star-o"></span>
                                    </div>
                                    <span class="rating-total pl-1">(20,230)</span>
                                </div>
                                <ul class="card-duration d-flex align-items-center fs-15 pb-2">
                                    <li class="mr-2">
                                        <span class="text-black">Status:</span>
                                        <span class="badge badge-success text-white">Published</span>
                                    </li>
                                    <li class="mr-2">
                                        <span class="text-black">Duration:</span>
                                        <span><?php echo $item->getCourse()->getDuration(); ?> hours </span>
                                    </li>
                                    <li class="mr-2">
                                        <span class="text-black">Students:</span>
                                        <span>30,405</span>
                                    </li>
                                </ul>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="card-price text-black font-weight-bold">$<?php echo $item->getCourse()->getSellingPrice(); ?></p>
                                    <div class="card-action-wrap pl-3">
                                        <a href="course-details.html" class="icon-element icon-element-sm shadow-sm cursor-pointer ml-1 text-success" data-toggle="tooltip" data-placement="top" data-title="View"><i class="la la-eye"></i></a>
                                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer ml-1 text-secondary" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="la la-edit"></i></div>
                                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer ml-1 text-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <span data-toggle="modal" data-target="#itemDeleteModal" class="w-100 h-100 d-inline-block"><i class="la la-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php require ABSPATH . 'resources/user/dashboard/layout/footer.php'; ?>

        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
</section>

<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
</div>

<!-- Modal -->
<div class="modal fade modal-container" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="la la-exclamation-circle fs-60 text-warning"></span>
                <h4 class="modal-title fs-19 font-weight-semi-bold pt-2 pb-1" id="deleteModalTitle">Your account will be deleted permanently!</h4>
                <p>Are you sure you want to delete your account?</p>
                <div class="btn-box pt-4">
                    <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Ok, Delete</button>
                </div>
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->

<?php require ABSPATH . 'resources/user/dashboard/layout/footerScript.php'; ?>