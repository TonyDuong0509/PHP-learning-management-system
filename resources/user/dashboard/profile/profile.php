<?php require ABSPATH . 'resources/user/dashboard/layout/header.php'; ?>

<section class="dashboard-area">
    <div class="off-canvas-menu dashboard-off-canvas-menu off--canvas-menu custom-scrollbar-styled pt-20px">
        <?php require ABSPATH . 'resources/user/dashboard/layout/sidebar.php'; ?>
    </div>

    <div class="dashboard-content-wrap">
        <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3">
            <i class="la la-bars mr-1"></i> Dashboard Nav
        </div>
        <div class="container-fluid">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
                <div class="media media-card align-items-center">
                    <div class="media-img media--img media-img-md rounded-full">
                        <img class="rounded-full" src="/<?php echo $user->getPhoto(); ?>" alt="Student thumbnail image">
                    </div>
                    <div class="media-body">
                        <h2 class="section__title fs-30"><?php echo $user->getName(); ?></h2>
                        <div class="rating-wrap d-flex align-items-center pt-2">
                            <div class="review-stars">
                                <span class="rating-number">4.4</span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star-o"></span>
                            </div>
                            <span class="rating-total pl-1">(20,230)</span>
                        </div><!-- end rating-wrap -->
                    </div><!-- end media-body -->
                </div><!-- end media -->
            </div><!-- end breadcrumb-content -->
            <div class="section-block mb-5"></div>
            <div class="dashboard-heading mb-5">
                <h3 class="fs-22 font-weight-semi-bold">Settings</h3>
            </div>
            <ul class="nav nav-tabs generic-tab pb-30px" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="edit-profile-tab" data-toggle="tab" href="#edit-profile" role="tab" aria-controls="edit-profile" aria-selected="false">
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="true">
                        Password
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="false">
                        Account
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
                    <div class="setting-body">
                        <h3 class="fs-17 font-weight-semi-bold pb-4">Edit Profile</h3>
                        <div class="media media-card align-items-center">
                            <form method="POST" action="<?php echo $router->generate('user.change.profile'); ?>" class="row pt-40px" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
                                <input type="hidden" name="old_image" value="<?php echo $user->getPhoto(); ?>">
                                <div class="media-img media-img-lg mr-4 bg-gray">
                                    <img id="showImage" src="/<?php echo $user->getPhoto(); ?>" alt="Category image" class="mr-3" width="80">
                                </div>
                                <div class="media-body">
                                    <div class="file-upload-wrap file-upload-wrap-2">
                                        <input type="file" name="photo" id="image" class="file-upload-input">
                                        <span class="file-upload-text"><i class="la la-photo mr-2"></i>Upload a Photo</span>
                                    </div><!-- file-upload-wrap -->
                                </div>
                        </div><!-- end media -->
                        <div class="input-box col-lg-6 mt-5">
                            <label class="label-text">Full Name</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="text" name="name" value="<?php echo $user->getName(); ?>">
                                <span class="la la-user input-icon"></span>
                            </div>
                        </div><!-- end input-box -->
                        <div class="input-box col-lg-6">
                            <label class="label-text">User Name</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="text" name="username" value="<?php echo $user->getUsername(); ?>">
                                <span class="la la-user input-icon"></span>
                            </div>
                        </div><!-- end input-box -->
                        <div class="input-box col-lg-6">
                            <label class="label-text">Email Address</label>
                            <div class="form-group">
                                <input disabled class="form-control form--control" type="email" name="email" value="<?php echo $user->getEmail(); ?>">
                                <span class="la la-envelope input-icon"></span>
                            </div>
                        </div><!-- end input-box -->
                        <div class="input-box col-lg-12 py-2">
                            <button class="btn theme-btn">Save Changes</button>
                        </div><!-- end input-box -->
                        </form>
                    </div><!-- end setting-body -->
                </div><!-- end tab-pane -->


                <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                    <div class="setting-body">
                        <h3 class="fs-17 font-weight-semi-bold pb-4">Change Password</h3>
                        <form method="POST" action="<?php echo $router->generate('user.change.password'); ?>" class="row">
                            <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
                            <div class="input-box col-lg-4">
                                <label class="label-text">Old Password</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="password" name="old_password" placeholder="Old Password">
                                    <span class="la la-lock input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-4">
                                <label class="label-text">New Password</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="password" name="new_password" id="new_password" placeholder="New Password" require>
                                    <span class="la la-lock input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-4">
                                <label class="label-text">Confirm New Password</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm New Password">
                                    <span class="la la-lock input-icon"></span>
                                    <span id='message'></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-12 py-2">
                                <button class="btn theme-btn">Change Password</button>
                            </div><!-- end input-box -->
                        </form>
                    </div><!-- end setting-body -->
                </div><!-- end tab-pane -->
                <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <div class="setting-body">
                        <div class="section-block"></div>
                        <div class="danger-zone pt-40px">
                            <h4 class="fs-17 font-weight-semi-bold text-danger">Delete Account Permanently</h4>
                            <p class="pt-1 pb-4"><span class="text-warning">Warning: </span>Once you delete your account, there is no going back. Please be certain.</p>
                            <form action="<?php echo $router->generate('user.delete.account', ['id' => $user->getId()]); ?>" method="POST">
                                <button type="submit" class="btn theme-btn" data-toggle="modal" data-target="#deleteModal">Delete my account</button>
                            </form>
                        </div>
                    </div><!-- end setting-body -->
                </div><!-- end tab-pane -->
            </div><!-- end tab-content -->
            <div class="row align-items-center dashboard-copyright-content pb-4">
                <div class="col-lg-6">
                    <p class="copy-desc">&copy; 2024 Aduca. All Rights Reserved</p>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14 justify-content-end">
                        <li class="mr-3"><a href="terms-and-conditions.html">Terms & Conditions</a></li>
                        <li><a href="privacy-policy.html">Privacy Policy</a></li>
                    </ul>
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
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

<script>
    $('#new_password, #new_password_confirmation').on('keyup', function() {
        if ($('#new_password').val() == $('#new_password_confirmation').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });
</script>