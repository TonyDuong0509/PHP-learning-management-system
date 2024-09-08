<section class="course-area pb-120px">
    <div class="bg-gray">
        <div class="container">
            <ul class="nav nav-tabs generic-tab justify-content-center py-4" id="myTab" role="tablist">
                <?php if (!empty($courseTypes)): ?>
                    <?php
                    // Determine the active type ID from the first course or a GET parameter
                    $activeTypeId = isset($_GET['type_id']) ? $_GET['type_id'] : $courses[0]->getTypeId();
                    ?>
                    <?php foreach ($courseTypes as $type): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($type->getId() == $activeTypeId) ? 'active' : ''; ?>"
                                id="trending-course-tab"
                                data-toggle="tab"
                                href="#trending-course<?php echo $type->getId() ?>"
                                role="tab"
                                aria-controls="trending-course<?php echo $type->getId() ?>"
                                aria-selected="<?php echo ($type->getId() == $activeTypeId) ? 'true' : 'false'; ?>">
                                <?php echo $type->getTitle() ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div><!-- end container -->
    </div>
    <div class="card-content-wrapper pt-50px">
        <div class="container">
            <div class="tab-content" id="myTabContent">
                <?php if (!empty($courseTypes)): ?>
                    <?php foreach ($courseTypes as $type): ?>
                        <div class="tab-pane fade <?php echo ($type->getId() == $activeTypeId) ? 'show active' : ''; ?>"
                            id="trending-course<?php echo $type->getId() ?>"
                            role="tabpanel"
                            aria-labelledby="trending-course-tab">
                            <div class="row">
                                <?php
                                // Filter courses by type_id
                                $filteredCourses = array_filter($courses, function ($course) use ($type) {
                                    return $course->getTypeId() == $type->getId();
                                });
                                ?>
                                <?php if (!empty($filteredCourses)): ?>
                                    <?php foreach ($filteredCourses as $course): ?>
                                        <div class="col-lg-4 responsive-column-half">
                                            <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_<?php echo $course->getId(); ?>">
                                                <div class="card-image">
                                                    <a href="<?php echo $router->generate('course.details', ['id' => $course->getId(), 'slug' => $course->getSlug()]); ?>" class="d-block">
                                                        <img style="width: 100%; height: 250px; object-fit: cover; object-position: center;" class="card-img-top lazy" src="<?php echo $course->getImage() ?? '/public/upload/no_image.png'; ?>" alt="Card image cap">
                                                    </a>
                                                    <div class="course-badge-labels">
                                                        <?php
                                                        $amount = number_format($course->getSellingPrice() - $course->getDiscountPrice(), 2);
                                                        $calc = ($amount / $course->getSellingPrice()) * 100;
                                                        $discount = 100 - $calc;
                                                        ?>
                                                        <?php if ($course->getBestseller() != 0): ?>
                                                            <div class="course-badge"><?php echo $course->getBestseller() == 1 ? 'Bestseller' : $course->getBestseller(); ?></div>
                                                        <?php elseif ($course->getFeatured() != 0): ?>
                                                            <div class="course-badge"><?php echo $course->getFeatured() == 1 ? 'Featured' : $course->getFeatured(); ?></div>
                                                        <?php elseif ($course->getHighestrated() != 0): ?>
                                                            <div class="course-badge"><?php echo $course->getHighestrated() == 1 ? 'Highest Rated' : $course->getHighestrated(); ?></div>
                                                        <?php endif; ?>
                                                        <?php if ($course->getDiscountPrice() != 0): ?>
                                                            <div class="course-badge blue">-<?php echo round($discount); ?>%</div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div><!-- end card-image -->
                                                <style>
                                                    h5 a {
                                                        display: block;
                                                        display: -webkit-box;
                                                        max-width: 100%;
                                                        height: 2.4em;
                                                        margin: 0 auto;
                                                        font-size: 16px;
                                                        line-height: 1.2em;
                                                        -webkit-line-clamp: 2;
                                                        -webkit-box-orient: vertical;
                                                        overflow: hidden;
                                                        text-overflow: ellipsis;
                                                        word-wrap: break-word;
                                                    }
                                                </style>
                                                <div class="card-body">
                                                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3"><?php echo $course->getLabel(); ?></h6>
                                                    <h5 class="card-title"><a href="<?php echo $router->generate('course.details', ['id' => $course->getId(), 'slug' => $course->getSlug()]); ?>"><?php echo $course->getName(); ?></a></h5>
                                                    <p class="card-text"><a href="<?php echo $router->generate('instructor.details', ['id' => $course->getInstructorId()]); ?>"><?php echo $course->getInstructorName(); ?></a></p>
                                                    <div class="rating-wrap d-flex align-items-center py-2">
                                                        <div class="review-stars">
                                                            <span class="rating-number"><?php echo count($reviews); ?></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star-o"></span>
                                                        </div>
                                                        <span class="rating-total pl-1">(<?php echo count($enrollmentStudents); ?> students)</span>
                                                    </div><!-- end rating-wrap -->
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <?php if ($course->getDiscountPrice() != 0): ?>
                                                            <p class="card-price text-black font-weight-bold">$<?php echo $amount; ?>
                                                                <span class="before-price font-weight-medium">$<?php echo number_format($course->getSellingPrice(), 2); ?></span>
                                                            </p>
                                                        <?php else: ?>
                                                            <p class="card-price text-black font-weight-bold">$<?php echo number_format($course->getSellingPrice(), 2); ?></p>
                                                        <?php endif; ?>
                                                        <button type="submit" class="btn theme-btn mr-3" onclick="addToCart(<?php echo $course->getId() ?>, '<?php echo $course->getName() ?>', '<?php echo $course->getInstructorId() ?>', '<?php echo $course->getSlug() ?>');"><i class="la la-shopping-cart mr-1 fs-18"></i>Add to Cart</button>
                                                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist" id="<?php echo $course->getId(); ?>" onclick="addToWishList(this.id);"><i class="la la-heart-o"></i></div>
                                                    </div>
                                                </div><!-- end card-body -->
                                            </div><!-- end card -->
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>No courses available for this type.</p>
                                <?php endif; ?>
                            </div><!-- end row -->
                        </div><!-- end tab-pane -->
                    <?php endforeach; ?>
                <?php endif; ?>
            </div><!-- end tab-content -->
            <div class="more-btn-box mt-4 text-center">
                <a href="/all/course" class="btn theme-btn">View all Courses <i class="la la-arrow-right icon ml-1"></i></a>
            </div><!-- end more-btn-box -->
        </div><!-- end container -->
    </div><!-- end card-content-wrapper -->
</section>