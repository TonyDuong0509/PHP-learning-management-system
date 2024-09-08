<?php

use Container\ServiceContainer;

$serviceContainer = new ServiceContainer();

$serviceContainer->add(App\Repositories\Interfaces\UserRepositoryInterface::class, new App\Repositories\UserRepository());
$serviceContainer->add(App\Services\UserService::class, new App\Services\UserService($serviceContainer->resolve(App\Repositories\Interfaces\UserRepositoryInterface::class)));

// All register of User

// All register of Instructor
$serviceContainer->add(App\Repositories\Interfaces\CategoryRepositoryInterface::class, new App\Repositories\CategoryRepository());
$serviceContainer->add(App\Services\CategoryService::class, new App\Services\CategoryService($serviceContainer->resolve(App\Repositories\Interfaces\CategoryRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\SubCategoryRepositoryInterface::class, new App\Repositories\SubCategoryRepository());
$serviceContainer->add(App\Services\SubCategoryService::class, new App\Services\SubCategoryService($serviceContainer->resolve(App\Repositories\Interfaces\SubCategoryRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\CourseRepositoryInterface::class, new App\Repositories\CourseRepository());
$serviceContainer->add(App\Services\CourseService::class, new App\Services\CourseService($serviceContainer->resolve(App\Repositories\Interfaces\CourseRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\CourseGoalsRepositoryInterface::class, new App\Repositories\CourseGoalsRepository());
$serviceContainer->add(App\Services\CourseGoalsService::class, new App\Services\CourseGoalsService($serviceContainer->resolve(App\Repositories\Interfaces\CourseGoalsRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\CourseSectionsRepositoryInterface::class, new App\Repositories\CourseSectionsRepository());
$serviceContainer->add(App\Services\CourseSectionsService::class, new App\Services\CourseSectionsService($serviceContainer->resolve(App\Repositories\Interfaces\CourseSectionsRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\CourseLecturesRepositoryInterface::class, new App\Repositories\CourseLecturesRepository());
$serviceContainer->add(App\Services\CourseLecturesService::class, new App\Services\CourseLecturesService($serviceContainer->resolve(App\Repositories\Interfaces\CourseLecturesRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\WishListRepositoryInterface::class, new App\Repositories\WishListRepository());
$serviceContainer->add(App\Services\WishListService::class, new App\Services\WishListService($serviceContainer->resolve(App\Repositories\Interfaces\WishListRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\OrdersRepositoryInterface::class, new App\Repositories\OrdersRepository());
$serviceContainer->add(App\Services\OrdersService::class, new App\Services\OrdersService($serviceContainer->resolve(App\Repositories\Interfaces\OrdersRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\CartRepositoryInterface::class, new App\Repositories\CartRepository());
$serviceContainer->add(App\Services\CartService::class, new App\Services\CartService($serviceContainer->resolve(App\Repositories\Interfaces\CartRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\CouponRepositoryInterface::class, new App\Repositories\CouponRepository());
$serviceContainer->add(App\Services\CouponService::class, new App\Services\CouponService($serviceContainer->resolve(App\Repositories\Interfaces\CouponRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\PaymentsRepositoryInterface::class, new App\Repositories\PaymentsRepository());
$serviceContainer->add(App\Services\PaymentsService::class, new App\Services\PaymentsService($serviceContainer->resolve(App\Repositories\Interfaces\PaymentsRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\QuestionsRepositoryInterface::class, new App\Repositories\QuestionsRepository());
$serviceContainer->add(App\Services\QuestionsService::class, new App\Services\QuestionsService($serviceContainer->resolve(App\Repositories\Interfaces\QuestionsRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\ReviewRepositoryInterface::class, new App\Repositories\ReviewRepository());
$serviceContainer->add(App\Services\ReviewService::class, new App\Services\ReviewService($serviceContainer->resolve(App\Repositories\Interfaces\ReviewRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\BlogCategoriesRepositoryInterface::class, new App\Repositories\BlogCategoriesRepository());
$serviceContainer->add(App\Services\BlogCategoriesService::class, new App\Services\BlogCategoriesService($serviceContainer->resolve(App\Repositories\Interfaces\BlogCategoriesRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\BLogPostsRepositoryInterface::class, new App\Repositories\BlogPostsRepository());
$serviceContainer->add(App\Services\BlogPostsService::class, new App\Services\BlogPostsService($serviceContainer->resolve(App\Repositories\Interfaces\BLogPostsRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\NotificationsRepositoryInterface::class, new App\Repositories\NotificationsRepository());
$serviceContainer->add(App\Services\NotificationsService::class, new App\Services\NotificationsService($serviceContainer->resolve(App\Repositories\Interfaces\NotificationsRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\RolesRepositoryInterface::class, new App\Repositories\RolesRepository());
$serviceContainer->add(App\Services\RolesService::class, new App\Services\RolesService($serviceContainer->resolve(App\Repositories\Interfaces\RolesRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\PermissionsRepositoryInterface::class, new App\Repositories\PermissionsRepository());
$serviceContainer->add(App\Services\PermissionsService::class, new App\Services\PermissionsService($serviceContainer->resolve(App\Repositories\Interfaces\PermissionsRepositoryInterface::class)));

$serviceContainer->add(App\Repositories\Interfaces\RoleHasPermissionsRepositoryInterface::class, new App\Repositories\RoleHasPermissionsRepository());
$serviceContainer->add(App\Services\RoleHasPermissionsService::class, new App\Services\RoleHasPermissionsService($serviceContainer->resolve(App\Repositories\Interfaces\RoleHasPermissionsRepositoryInterface::class)));
