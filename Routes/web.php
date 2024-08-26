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

$match = $router->match();
