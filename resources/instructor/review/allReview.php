<?php require ABSPATH . 'resources/instructor/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/instructor/layout/header.php'; ?>

<?php
$router = $router;
?>

<style>
    .large-checkbox {
        transform: scale(1.5);
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Active Review </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Course Name </th>
                                <th>Username </th>
                                <th>Rating </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($reviews)): ?>
                                <?php foreach ($reviews as $key => $review): ?>
                                    <tr>
                                        <td>
                                            <?php echo $key++; ?>
                                        </td>
                                        <td>
                                            <?php echo $review->getCourse()->getName(); ?>
                                        </td>
                                        <td>
                                            <?php echo $review->getUser()->getName(); ?>
                                        </td>
                                        <td>
                                            <?php if ($review->getRating() == null): ?>
                                                <i class="bx bxs-star text-secondary"></i>
                                                <i class="bx bxs-star text-secondary"></i>
                                                <i class="bx bxs-star text-secondary"></i>
                                                <i class="bx bxs-star text-secondary"></i>
                                                <i class="bx bxs-star text-secondary"></i>
                                            <?php elseif ($review->getRating() == 1): ?>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-secondary"></i>
                                                <i class="bx bxs-star text-secondary"></i>
                                                <i class="bx bxs-star text-secondary"></i>
                                                <i class="bx bxs-star text-secondary"></i>
                                            <?php elseif ($review->getRating() == 2): ?>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-secondary"></i>
                                                <i class="bx bxs-star text-secondary"></i>
                                                <i class="bx bxs-star text-secondary"></i>
                                            <?php elseif ($review->getRating() == 3): ?>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-secondary"></i>
                                                <i class="bx bxs-star text-secondary"></i>
                                            <?php elseif ($review->getRating() == 4): ?>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-secondary"></i>
                                            <?php elseif ($review->getRating() == 5): ?>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                    </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require ABSPATH . 'resources/instructor/layout/footer.php'; ?>

</div>

<?php require ABSPATH . 'resources/instructor/layout/footerScript.php'; ?>

<script src="<?php ABSPATH ?>/instructor/public/js/app.js"></script>
<script>
    new PerfectScrollbar(".app-container")
</script>
</body>

</html>