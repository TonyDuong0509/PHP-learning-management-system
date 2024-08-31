<section class="blog-area section--padding bg-gray overflow-hidden">
    <div class="container">
        <div class="section-heading text-center">
            <h5 class="ribbon ribbon-lg mb-2">News feeds</h5>
            <h2 class="section__title">Latest News & Articles</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->
        <div class="blog-post-carousel owl-action-styled half-shape mt-30px">

            <?php if (!empty($blogPosts)): ?>
                <?php foreach ($blogPosts as $post): ?>
                    <div class="card card-item">
                        <div class="card-image">
                            <a href="<?php echo $router->generate('blog.details', ['slug' => $post->getPostSlug()]); ?>" class="d-block">
                                <img style="width: 100%; height: 240px; object-fit: cover;" class="card-img-top" src="/<?php echo $post->getPostImage(); ?>" alt="Card image cap">
                            </a>
                            <div class="course-badge-labels">
                                <div class="course-badge"><?php echo $post->getCreatedAt(); ?></div>
                            </div>
                        </div><!-- end card-image -->
                        <div class="card-body">
                            <h5 class="card-title"><a href="<?php echo $router->generate('blog.details', ['slug' => $post->getPostSlug()]); ?>"><?php echo $post->getPostTitle(); ?></a></h5>
                            <ul class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                                <li class="d-flex align-items-center">By<a href="#">TechyDevs</a></li>
                                <li class="d-flex align-items-center"><a href="#">4 Comments</a></li>
                                <li class="d-flex align-items-center"><a href="#">130 Likes</a></li>
                            </ul>
                            <div class="d-flex justify-content-between align-items-center pt-3">
                                <a href="blog-single.html" class="btn theme-btn theme-btn-sm theme-btn-white">Read More <i class="la la-arrow-right icon ml-1"></i></a>
                                <div class="share-wrap">
                                    <ul class="social-icons social-icons-styled">
                                        <li class="mr-0"><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                                        <li class="mr-0"><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                                        <li class="mr-0"><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                                    </ul>
                                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer share-toggle" title="Toggle to expand social icons"><i class="la la-share-alt"></i></div>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div><!-- end blog-post-carousel -->
    </div><!-- end container -->
</section><!-- end blog-area -->