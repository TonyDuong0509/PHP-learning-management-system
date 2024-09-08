<?php require ABSPATH . 'resources/user/layout/header.php'; ?>

<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white"><?php echo $subCategoryCourse->getName(); ?></h2>
            </div>
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="index.html">Home</a></li>
                <li><?php echo $subCategoryCourse->getCategoryName(); ?></li>
                <li><?php echo $subCategoryCourse->getName(); ?></li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->

<section class="course-area section--padding">
    <div class="container">
        <div class="filter-bar mb-4">
            <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
                <p class="fs-14">We found <span class="text-black"><?php echo count($courses); ?></span> courses available for you</p>
            </div><!-- end filter-bar-inner -->
        </div><!-- end filter-bar -->
        <div class="row">
            <div class="col-lg-4">
                <div class="sidebar mb-5">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Search Field</h3>
                            <div class="divider"><span></span></div>
                            <form method="post">
                                <div class="form-group mb-0">
                                    <input class="form-control form--control pl-3" type="text" name="search" placeholder="Search courses">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                        </div>
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Course Categories</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item">
                                <?php if (!empty($categories)): ?>
                                    <?php foreach ($categories as $category): ?>
                                        <li>
                                            <a href="<?php echo $router->generate('course.category', ['id' => $category->getId(), 'slug' => $category->getSlug()]); ?>">
                                                <?php echo $category->getName(); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div><!-- end card -->
                </div><!-- end sidebar -->
            </div><!-- end col-lg-4 -->

            <div class="col-lg-8">
                <div class="row">

                    <?php if (!empty($courses)): ?>
                        <?php foreach ($courses as $course): ?>
                            <div class="col-lg-6 responsive-column-half">
                                <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1">
                                    <div class="card-image">
                                        <a href="<?php echo $router->generate('course.details', ['id' => $course->getId(), 'slug' => $course->getSlug()]); ?>" class="d-block">
                                            <img style="width: 100%; height: 250px; object-fit: cover;" class="card-img-top" src="../<?php echo $course->getImage(); ?>" alt="Card image cap">
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
                            </div><!-- end col-lg-6 -->
                </div><!-- end card -->
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

        </div><!-- end row -->
        <div class="text-center pt-3">
            <nav aria-label="Page navigation example" class="pagination-box">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true"><i class="la la-arrow-left"></i></span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true"><i class="la la-arrow-right"></i></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <p class="fs-14 pt-2">Showing 1-10 of 56 results</p>
        </div>
    </div><!-- end col-lg-8 -->
    </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end courses-area -->

<div class="section-block"></div>

<?php require ABSPATH . 'resources/user/layout/footer.php'; ?>

<!-- start scroll top -->
<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
</div>
<!-- end scroll top -->

<div class="tooltip_templates">
    <div id="tooltip_content_1">
        <div class="card card-item">
            <div class="card-image">
                <a href="<?php echo $router->generate('course.details', ['id' => $course->getId(), 'slug' => $course->getSlug()]); ?>" class="d-block">
                    <img style="width: 100%; height: 250px; object-fit: cover;" class="card-img-top" src="../<?php echo $course->getImage(); ?>" alt="Card image cap">
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
            <div class="card-body">
                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3"><?php echo $course->getLabel(); ?></h6>
                <h5 class="card-title"><a href="<?php echo $router->generate('course.details', ['id' => $course->getId(), 'slug' => $course->getSlug()]); ?>"><?php echo $course->getName(); ?></a></h5>
                <p class="card-text"><a href="<?php echo $router->generate('instructor.details', ['id' => $course->getInstructorId()]); ?>"><?php echo $course->getInstructorName(); ?></a></p>
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
    </div><!-- end col-lg-6 -->
</div><!-- end card -->
</div>
</div><!-- end tooltip_templates -->

<!-- Modal -->
<div class="modal fade modal-container" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="reportModalTitle">Report Abuse</h5>
                    <p class="pt-1 fs-14 lh-24">Flagged content is reviewed by Aduca staff to determine whether it violates Terms of Service or Community Guidelines. If you have a question or technical issue, please contact our
                        <a href="contact.html" class="text-color hover-underline">Support team here</a>.
                    </p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form method="post">
                    <div class="input-box">
                        <label class="label-text">Select Report Type</label>
                        <div class="form-group">
                            <div class="select-container w-auto">
                                <select class="select-container-select">
                                    <option value>-- Select One --</option>
                                    <option value="1">Inappropriate Course Content</option>
                                    <option value="2">Inappropriate Behavior</option>
                                    <option value="3">Aduca Policy Violation</option>
                                    <option value="4">Spammy Content</option>
                                    <option value="5">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-box">
                        <label class="label-text">Write Message</label>
                        <div class="form-group">
                            <textarea class="form-control form--control pl-3" name="message" placeholder="Provide additional details here..." rows="5"></textarea>
                        </div>
                    </div>
                    <div class="btn-box text-right pt-2">
                        <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Submit <i class="la la-arrow-right icon ml-1"></i></button>
                    </div>
                </form>
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->


<?php require ABSPATH . 'resources/user/layout/footerScript.php'; ?>
</body>

</html>