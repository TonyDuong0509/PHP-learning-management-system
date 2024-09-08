<?php

use Container\ServiceContainer;

$router = new AltoRouter();

$serviceContainer = new ServiceContainer();

// Admin routes
$router->map('GET', '/admin/dashboard', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->index();
}, 'admin.dashboard');

$router->map('GET', '/admin/login/form', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AdminController::class);
    $controller->loginForm();
}, 'admin.login.form');

$router->map('POST', '/admin/login', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AdminController::class);
    $controller->login();
}, 'admin.login');

$router->map('GET', '/admin/logout', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AdminController::class);
    $controller->logout();
}, 'admin.logout');

$router->map('GET', '/admin/pending/order', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\OrderController::class);
    $controller->adminPendingOrder();
}, 'admin.pending.order');

$router->map('GET', '/admin/order/details/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\OrderController::class);
    $controller->adminOrderDetails($id);
}, 'admin.order.details');

$router->map('GET', '/pending-confirm-instructor/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\OrderController::class);
    $controller->pendingConfirmByInstructor($id);
}, 'pending-confirm-instructor');

$router->map('GET', '/pending-confirm-admin/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\OrderController::class);
    $controller->pendingConfirmByAdmin($id);
}, 'pending-confirm-admin');

$router->map('GET', '/admin/confirm/order', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\OrderController::class);
    $controller->adminConfirmOrder();
}, 'admin.confirm.order');

$router->map('GET', '/admin/profile/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AdminController::class);
    $controller->profile($id);
}, 'admin.profile');

$router->map('POST', '/admin/store/profile', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AdminController::class);
    $controller->storeProfile();
}, 'admin.store.profile');

$router->map('GET', '/admin/change/password/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AdminController::class);
    $controller->changePassword($id);
}, 'admin.change.password');

$router->map('POST', '/admin/update/password', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AdminController::class);
    $controller->updatePassword();
}, 'admin.update.password');

$router->map('POST', '/admin/active/instructor/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->activeInstructor($id);
}, 'admin.active.instructor');

$router->map('GET', '/all/users', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->allUser();
});


// Category
$router->map('GET', '/admin/manage-category', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->manageCategory();
});

$router->map('GET', '/admin/manage-subcategory', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->manageSubCategory();
});

$router->map('GET', '/admin/add-category', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->addCategory();
});

$router->map('GET', '/admin/add-category', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->addSubCategory();
});

$router->map('POST', '/admin/store-category', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->storeCategory();
}, 'admin.store.category');

$router->map('GET', '/admin/edit-category/[i:cid]', function ($cid) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->edit($cid);
}, 'admin.edit.category');

$router->map('POST', '/admin/update-category', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->updateCategory();
}, 'admin.update.category');

$router->map('GET', '/admin/destroy-category/[i:cid]', function ($cid) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->destroy($cid);
});


// SubCategory
$router->map('GET', '/admin/add-subcategory', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->addSubCategory();
});

$router->map('GET', '/admin/manage-subcategory', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->manageSubCategory();
});

$router->map('GET', '/admin/edit-subcategory/[i:subCid]', function ($subCid) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->editSubCategory($subCid);
});

$router->map('POST', '/admin/store-subcategory', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->storeSubCategory();
}, 'admin.store.subcategory');

$router->map('POST', '/admin/update-subcategory', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->updateSubCategory();
}, 'admin.update.subcategory');

$router->map('GET', '/admin/destroy-subcategory/[i:subCid]', function ($subCid) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->destroySubCategory($subCid);
}, 'admin.destroy.subcategory');


// Course
$router->map('GET', '/admin/all/course', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->manageCourse();
});

$router->map('POST', '/admin/update/course-status', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->updateCourseStatus();
}, 'admin.update.course-status');

$router->map('GET', '/admin/course/details/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->courseDetails($id);
}, 'admin.course.details');


// Coupon
$router->map('GET', '/admin/all/coupon', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\CouponController::class);
    $controller->adminAllCoupon();
});

$router->map('GET', '/admin/active/coupon/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\CouponController::class);
    $controller->activeCoupon($id);
});

$router->map('GET', '/admin/inactive/coupon/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\CouponController::class);
    $controller->inactiveCoupon($id);
});

$router->map('GET', '/admin/destroy/coupon/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\CouponController::class);
    $controller->destroyCoupon($id);
});

$router->map('POST', '/coupon-apply', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\CartController::class);
    $controller->applyCoupon();
});

$router->map('GET', '/coupon-calculation', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\CartController::class);
    $controller->couponCalculation();
});

$router->map('GET', '/coupon-remove', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\CartController::class);
    $controller->couponRemove();
});


// Checkout route
$router->map('GET', '/checkout', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\CartController::class);
    $controller->checkoutCreate();
}, 'checkout');

$router->map('POST', '/payment', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\CartController::class);
    $controller->payment();
}, 'payment');

// User routes
$router->map('GET', '/', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\HomeController::class);
    $controller->index();
}, 'home');

$router->map('GET', '/user/dashboard', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->dashboard();
}, 'user.dashboard');

$router->map('GET', '/all/course', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->allCourse();
});

$router->map('GET', '/course-details/[i:id]/[*:slug]', function ($id, $slug) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\DetailsController::class);
    $controller->index($id, $slug);
}, 'course.details');

$router->map('GET', '/category/[i:id]/[*:slug]', function ($id, $slug) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\DetailsController::class);
    $controller->categoryCourse($id, $slug);
}, 'course.category');

$router->map('GET', '/subcategory/[i:id]/[*:slug]', function ($id, $slug) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\DetailsController::class);
    $controller->subCategoryCourse($id, $slug);
}, 'course.subCategory');

$router->map('GET', '/instructor/details/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\DetailsController::class);
    $controller->InstructorDetails($id);
}, 'instructor.details');

$router->map('POST', '/add-to-wishlist/[i:course_id]', function ($course_id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\WishListController::class);
    $controller->addToWishList($course_id);
});

$router->map('GET', '/register', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->registerForm();
}, 'register');

$router->map('POST', '/user-register', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->register();
}, 'user.register');

$router->map('GET', '/login', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->loginForm();
}, 'login');

$router->map('POST', '/user-login', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->login();
}, 'user.login');

$router->map('GET', '/logout', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->logout();
}, 'logout');

$router->map('GET', '/my/course', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\OrderController::class);
    $controller->myCourse();
}, 'my.course');

$router->map('GET', '/course/view/[i:course_id]', function ($course_id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\OrderController::class);
    $controller->courseView($course_id);
}, 'course.view');

$router->map('POST', '/user/question', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\QuestionController::class);
    $controller->userQuestion();
}, 'user.question');

$router->map('GET', '/user/profile/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->profile($id);
}, 'user.profile');

$router->map('POST', '/user/change/profile', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->changeProfile();
}, 'user.change.profile');

$router->map('POST', '/user/change/password', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->changePassword();
}, 'user.change.password');

$router->map('POST', '/user/delete/account/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->deleteUserAccountBySelf($id);
}, 'user.delete.account');


// Question routes
$router->map('GET', '/quest/details/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\QuestionController::class);
    $controller->questionDetails($id);
}, 'question.details');

$router->map('POST', '/instructor/reply', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\QuestionController::class);
    $controller->instructorReply();
}, 'instructor.reply');


// Cart routes
$router->map('POST', '/cart/data/store/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\CartController::class);
    $controller->addToCart($id);
}, 'add.to.cart');

$router->map('GET', '/cart/data/', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\CartController::class);
    $controller->cartData();
});

$router->map('GET', '/course/mini/cart', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\CartController::class);
    $controller->addMiniCart();
});

$router->map('GET', '/mycart', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\CartController::class);
    $controller->myCart();
}, 'mycart');

$router->map('GET', '/get-cart-course', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\CartController::class);
    $controller->getCartCourse();
});

$router->map('GET', '/cart-remove/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\CartController::class);
    $controller->cartRemove($id);
});


// Instructor routes
$router->map('GET', '/instructor/dashboard', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\InstructorController::class);
    $controller->dashboard();
}, 'dashboard');

$router->map('GET', '/instructor/register/form', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\InstructorController::class);
    $controller->registerForm();
}, 'instructor.register.form');

$router->map('POST', '/instructor/register', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\InstructorController::class);
    $controller->register();
}, 'instructor.register');

$router->map('GET', '/instructor/login/form', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\InstructorController::class);
    $controller->loginForm();
}, 'instructor.login.form');

$router->map('POST', '/instructor/login', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\InstructorController::class);
    $controller->login();
}, 'instructor.login');

$router->map('GET', '/instructor/courses', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->manageCourse();
}, 'all.course');

$router->map('GET', '/instructor/category-subcategory/[i:cid]', function ($cid) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->subCategoryAjax($cid);
});

$router->map('GET', '/instructor/add-course', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->addCourse();
}, 'add.course');

$router->map('POST', '/instructor/store-course', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->storeCourse();
}, 'store.course');

$router->map('GET', '/instructor/edit-course/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->editCourse($id);
}, 'edit.course');

$router->map('POST', '/instructor/update-course', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->updateCourse();
}, 'update.course');

$router->map('POST', '/instructor/update-course-image', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->updateCourseImage();
}, 'update.course.image');

$router->map('POST', '/instructor/update-course-video', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->updateCourseVideo();
}, 'update.course.video');

$router->map('POST', '/instructor/update-course-goals', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->updateCourseGoals();
}, 'update.course.goals');

$router->map('GET', '/instructor/delete-course/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->deleteCourse($id);
}, 'delete.course');

$router->map('POST', '/instructor/store-course-lecture', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->storeLecture();
}, 'store.course.lecture');

$router->map('POST', '/instructor/update-course-lecture', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->updateCourseLecture();
}, 'update.course.lecture');

$router->map('POST', '/instructor/delete-course-lecture/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->deleteLecture($id);
}, 'delete.course.lecture');

$router->map('POST', '/instructor/store-course-section', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->storeSection();
}, 'store.course.section');

$router->map('POST', '/instructor/delete-course-section/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->deleteSection($id);
}, 'delete.course.section');

$router->map('GET', '/instructor/add-course-lecture/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->addCourseLecture($id);
}, 'add.course.lecture');

$router->map('GET', '/instructor/edit-course-lecture/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->editCourseLecture($id);
}, 'edit.course.lecture');

$router->map('GET', '/instructor/logout', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\InstructorController::class);
    $controller->logout();
}, 'instructor.logout');

$router->map('GET', '/admin/manage-instructor', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->manageInstructor();
});

$router->map('GET', '/instructor/all/order', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\OrderController::class);
    $controller->instructorAllOrder();
});

$router->map('GET', '/instructor/order/details/[i:payment_id]', function ($payment_id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\OrderController::class);
    $controller->instructorOrderDetails($payment_id);
}, 'instructor.order.details');

$router->map('GET', '/instructor/profile/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\InstructorController::class);
    $controller->instructorProfile($id);
}, 'instructor.profile');

$router->map('POST', '/instructor/update/profile', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\InstructorController::class);
    $controller->updateProfile();
}, 'instructor.update.profile');

$router->map('GET', '/instructor/edit/password/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\InstructorController::class);
    $controller->editPassword($id);
}, 'instructor.edit.password');

$router->map('POST', '/instructor/change/password', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\InstructorController::class);
    $controller->changePassword();
}, 'instructor.change.password');


// WishLists routes
$router->map('GET', '/user/wishlist', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\WishListController::class);
    $controller->allWishList();
}, 'user.wishlist');

$router->map('GET', '/get-wishlist-course', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\WishListController::class);
    $controller->getWishListsCourse();
});

$router->map('GET', '/remove-wishlist/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\WishListController::class);
    $controller->removeWishList($id);
});


// Stripe routes
$router->map('GET', '/stripe-payment', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\CartController::class);
    $controller->stripePayment();
});

$router->map('POST', '/stripe-order', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\CartController::class);
    $controller->stripeOrder();
}, 'stripe.order');


// Report routes
$router->map('GET', '/report/view', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\ReportController::class);
    $controller->reportView();
});

$router->map('POST', '/search/by/date', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\ReportController::class);
    $controller->searchByDate();
}, 'admin.search.by.date');

$router->map('POST', '/search/by/month', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\ReportController::class);
    $controller->searchByMonth();
}, 'admin.search.by.month');

$router->map('POST', '/search/by/year', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\ReportController::class);
    $controller->searchByYear();
}, 'admin.search.by.year');


// Instructor coupon routes
$router->map('GET', '/instructor/all/coupon', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\CouponController::class);
    $controller->instructorAllCoupon();
});

$router->map('GET', '/instructor/add/coupon', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\CouponController::class);
    $controller->instructorAddCoupon();
}, 'instructor.add.coupon');

$router->map('POST', '/instructor/store/coupon', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\CouponController::class);
    $controller->instructorStoreCoupon();
}, 'instructor.store.coupon');

$router->map('GET', '/instructor/edit/coupon/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\CouponController::class);
    $controller->instructorEditCoupon($id);
}, 'instructor.edit.coupon');

$router->map('POST', '/instructor/update/coupon', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\CouponController::class);
    $controller->instructorUpdateCoupon();
}, 'instructor.update.coupon');

$router->map('GET', '/instructor/delete/coupon/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\CouponController::class);
    $controller->instructorDeleteCoupon($id);
}, 'instructor.delete.coupon');


// Review routes
$router->map('POST', '/store/review', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\ReviewController::class);
    $controller->storeReview();
}, 'store.review');

$router->map('GET', '/instructor/all/review', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\ReviewController::class);
    $controller->instructorAllReview();
});


// Blog roues
$router->map('GET', '/blog/category', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\BlogController::class);
    $controller->allBlogCategory();
});

$router->map('POST', '/blog/category/store', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\BlogController::class);
    $controller->storeBlogCategory();
}, 'blog.category.store');

$router->map('GET', '/blog/category/edit/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\BlogController::class);
    $controller->editBlogCategory($id);
}, 'blog.category.edit');

$router->map('POST', '/blog/category/update', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\BlogController::class);
    $controller->updateBlogCategory();
}, 'blog.category.update');

$router->map('GET', '/blog/category/delete/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\BlogController::class);
    $controller->deleteBlogCategory($id);
}, 'blog.category.delete');


// Blog Posts routes
$router->map('GET', '/blog/posts', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\BlogPostsController::class);
    $controller->blogPosts();
});

$router->map('GET', '/add/blog/posts', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\BlogPostsController::class);
    $controller->addBlogPosts();
}, 'blog.posts.add');

$router->map('POST', '/store/blog/posts', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\BlogPostsController::class);
    $controller->storeBlogPosts();
}, 'blog.posts.store');

$router->map('GET', '/edit/blog/posts/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\BlogPostsController::class);
    $controller->editBlogPosts($id);
}, 'blog.posts.edit');

$router->map('POST', '/update/blog/posts', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\BlogPostsController::class);
    $controller->updateBlogPosts();
}, 'blog.posts.update');

$router->map('GET', '/delete/blog/posts/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\BlogPostsController::class);
    $controller->deleteBlogPosts($id);
}, 'blog.posts.delete');

$router->map('GET', '/blog/details/[*:slug]', function ($slug) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\BlogPostsController::class);
    $controller->blogDetails($slug);
}, 'blog.details');

$router->map('GET', '/blog/category/list/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\BlogPostsController::class);
    $controller->blogCategoryList($id);
});

$router->map('GET', '/blog/posts/all', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\BlogPostsController::class);
    $controller->allBlogPosts();
});


// Notification routes
$router->map('POST', '/notification/update/status', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\InstructorController::class);
    $controller->updateStatusNotifications();
}, 'notification.update.status');

// Permissions routes
$router->map('GET', '/all/permission', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->allPermissions();
});

$router->map('GET', '/add/permission', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->addPermission();
}, 'add.permission');

$router->map('POST', '/store/permission', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->storePermission();
}, 'store.permission');

$router->map('GET', '/edit/permission/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->editPermission($id);
}, 'edit.permission');

$router->map('POST', '/update/permission', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->updatePermission();
}, 'update.permission');

$router->map('GET', '/delete/permission/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->deletePermission($id);
}, 'delete.permission');


// Roles routes
$router->map('GET', '/all/roles', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->allRoles();
});

$router->map('GET', '/add/role', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->addRole();
}, 'add.role');

$router->map('POST', '/store/role', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->storeRole();
}, 'store.role');

$router->map('GET', '/edit/role/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->editRole($id);
}, 'edit.role');

$router->map('POST', '/update/role', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->updateRole();
}, 'update.role');

$router->map('GET', '/delete/role/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->deleteRole($id);
}, 'delete.role');

$router->map('GET', '/add/roles/permission', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->addRolesPermission();
}, 'add.roles.permission');

$router->map('POST', '/role/permission/store', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->rolePermissionStore();
}, 'role.permission.store');

$router->map('GET', '/all/roles/permission', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->allRolesPermission();
}, 'all.roles.permission');

$router->map('GET', '/admin/edit/roles/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->adminEditRoles($id);
}, 'admin.edit.roles');

$router->map('POST', '/admin/roles/update/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->adminUpdateRoles($id);
}, 'admin.roles.update');

$router->map('GET', '/admin/roles/delete/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->adminDeleteRoles($id);
}, 'admin.roles.delete');


// Multi Admin routes
$router->map('GET', '/all/admin', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AdminController::class);
    $controller->allAdmin();
});

$router->map('GET', '/add/admin', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AdminController::class);
    $controller->addAdmin();
}, 'add.admin');

$router->map('POST', '/store/admin', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AdminController::class);
    $controller->storeAdmin();
}, 'store.admin');

$router->map('GET', '/edit/admin/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AdminController::class);
    $controller->editAdmin($id);
}, 'edit.admin');

$router->map('POST', '/update/admin', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AdminController::class);
    $controller->updateAdmin();
}, 'update.admin');

$router->map('GET', '/delete/admin/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AdminController::class);
    $controller->deleteAdmin($id);
}, 'delete.admin');

$match = $router->match();
