<?php require ABSPATH . 'resources/user/dashboard/layout/header.php'; ?>

<section class="dashboard-area">
    <div class="off-canvas-menu dashboard-off-canvas-menu off--canvas-menu custom-scrollbar-styled pt-20px">

        <?php require ABSPATH . 'resources/user/dashboard/layout/sidebar.php'; ?>

    </div>
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
                <div class="media media-card align-items-center">
                    <div class="media-img media--img media-img-md rounded-full">
                        <img class="rounded-full" src="/<?php echo $user->getPhoto(); ?>" alt="Student thumbnail image">
                    </div>
                </div><!-- end media -->
            </div><!-- end breadcrumb-content -->

            <div class="container-fluid">

                <div class="section-block mb-5"></div>
                <div class="dashboard-heading mb-5">
                    <h3 class="fs-22 font-weight-semi-bold">My Bookmarks</h3>
                </div>
                <div class="row" id="wishlist">

                </div>
            </div>

            <?php require ABSPATH . 'resources/user/dashboard/layout/footer.php'; ?>

        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
</section>

<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
</div>

<?php require ABSPATH . 'resources/user/dashboard/layout/footerScript.php'; ?>