<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="<?php ABSPATH ?>/public/backend/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="<?php ABSPATH ?>/public/backend/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?php ABSPATH ?>/public/backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?php ABSPATH ?>/public/backend/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="<?php ABSPATH ?>/public/backend/css/pace.min.css" rel="stylesheet" />
    <script src="<?php ABSPATH ?>/public/backend/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="<?php ABSPATH ?>/public/backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php ABSPATH ?>/public/backend/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="<?php ABSPATH ?>/public/backend/css/app.css" rel="stylesheet">
    <link href="<?php ABSPATH ?>/public/backend/css/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Instructor Register</title>
</head>

<body class="">
    <!--wrapper-->
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="p-4">
                                    <div class="mb-3 text-center">
                                        <img src="../public/backend/images/logo-icon.png" width="60" alt="" />
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5 class="">Aduca Instructor</h5>
                                        <p class="mb-0">Please fill the below details to create your account</p>
                                    </div>
                                    <div class="form-body">
                                        <form action="?c=instructor&a=register" method="POST" class="row g-3">
                                            <div class="col-12">
                                                <label for="inputName" class="form-label">Full Name</label>
                                                <input type="text" class="form-control" id="inputName" required placeholder="..." name="name">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputUsername" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="inputUsername" required placeholder="..." name="username">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="inputEmailAddress" required placeholder="example@user.com" name="email">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" id="inputChoosePassword" required placeholder="Enter Password" name="password"><a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Sign up</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center ">
                                                    <p class="mb-0">Already have an account? <a href="login.php">Sign in here</a></p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="login-separater text-center mb-5"> <span>OR SIGN UP WITH EMAIL</span>
                                        <hr />
                                    </div>
                                    <div class="list-inline contacts-social text-center">
                                        <a href="javascript:;" class="list-inline-item bg-facebook text-white border-0 rounded-3"><i class="bx bxl-facebook"></i></a>
                                        <a href="javascript:;" class="list-inline-item bg-google text-white border-0 rounded-3"><i class="bx bxl-google"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="<?php ABSPATH ?>/public/backend/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?php ABSPATH ?>/public/backend/js/jquery.min.js"></script>
    <script src="<?php ABSPATH ?>/public/backend/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?php ABSPATH ?>/public/backend/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?php ABSPATH ?>/public/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="../public/backend/js/app.js"></script>
    <?php include ABSPATH . 'resources/script.php'; ?>
</body>

</html>