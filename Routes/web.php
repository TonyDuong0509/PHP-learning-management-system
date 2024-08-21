<?php

use Container\ServiceContainer;

$router = new AltoRouter();

$serviceContainer = new ServiceContainer();

// Admin routes
$router->map('GET', '/admin/dashboard', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->index();
});

$router->map('GET', '/admin/logout', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\AuthController::class);
    $controller->logout();
});


// Instructor
$router->map('GET', '/admin/manage-instructor', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\DashboardController::class);
    $controller->manageInstructor();
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

$router->map('GET', '/admin/add/coupon', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\CouponController::class);
    $controller->adminAddCoupon();
});

$router->map('POST', '/admin/store/coupon', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\CouponController::class);
    $controller->storeCoupon();
}, 'admin.store.coupon');

$router->map('GET', '/admin/edit/coupon/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\CouponController::class);
    $controller->editCoupon($id);
});

$router->map('POST', '/admin/update/coupon', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Admin\CouponController::class);
    $controller->updateCoupon();
}, 'admin.update.coupon');

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


// User routes
$router->map('GET', '/', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\HomeController::class);
    $controller->index();
}, 'home');

$router->map('GET', '/user/dashboard', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->dashboard();
}, 'user.dashboard');

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

$router->map('GET', '/login', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->loginForm();
}, 'login');

$router->map('GET', '/logout', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->logout();
}, 'logout');


// Cart routes
$router->map('POST', '/cart/data/store/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\CartController::class);
    $controller->addToCart($id);
});

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

$router->map('GET', '/instructor/courses', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->manageCourse();
}, 'all.course');

$router->map('GET', '/instructor/add-course', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->addCourse();
}, 'add.course');

$router->map('GET', '/instructor/edit-course/[i:id]', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->editCourse($id);
}, 'edit.course');

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

$match = $router->match();
$routeName = is_array($match) ? ($match['name'] ?? null) : null;
