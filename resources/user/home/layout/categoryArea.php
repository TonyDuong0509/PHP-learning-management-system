<?php
$icons = [
    'la la-desktop',
    'la la-briefcase',
    'la la-paint-brush',
    'la la-laptop',
    'la la-camera',
    'la la-magic',
    'la la-music',
    'la la-medkit',
];

$colors = [
    'text-color',
    'text-color-2',
    'text-color-3',
    'text-color-4',
    'text-color-5',
    'text-color-6',
    'text-color-7',
    'text-color-8',
];
?>

<section class="category-area section-padding text-center position-relative">
    <span class="ring-shape ring-shape-1"></span>
    <span class="ring-shape ring-shape-2"></span>
    <span class="ring-shape ring-shape-3"></span>
    <span class="ring-shape ring-shape-4"></span>
    <span class="ring-shape ring-shape-5"></span>
    <span class="ring-shape ring-shape-6"></span>
    <span class="ring-shape ring-shape-7"></span>
    <div class="container">
        <div class="section-heading">
            <h2 class="section__title mb-2">Browse Top Categories</h2>
            <p class="section__desc">Get unlimited access to all categories</p>
        </div><!-- end section-heading -->
        <div class="row pt-50px">

            <?php if (!empty($categoriesArea)): ?>
                <?php foreach ($categoriesArea as $index => $categoryArea): ?>
                    <div class="col-lg-3 responsive-column-half">
                        <div class="category-item category-item-layout-2">
                            <a href="<?php echo $router->generate('course.category', ['id' => $categoryArea->getId(), 'slug' => $categoryArea->getSlug()]); ?>" class="category-content">
                                <div class="icon-element icon-element-md shadow-sm <?php echo $colors[$index % count($colors)]; ?>">
                                    <i class="<?php echo $icons[$index % count($icons)]; ?>"></i>
                                </div>
                                <h3 class="cat__title"><?php echo $categoryArea->getName(); ?></h3>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>