<?php
require_once ABSPATH . "app/Repositories/Interfaces/UserRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/CategoryRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/SubCategoryRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/CourseGoalsRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/CourseSectionsRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/CourseLecturesRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/CourseRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/CourseTypesRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/WishListRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/OrdersRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/CartRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/CouponRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/PaymentsRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/QuestionsRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/ReviewRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/BlogCategoriesRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/BLogPostsRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/NotificationsRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/RolesRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/PermissionsRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/RoleHasPermissionsRepositoryInterface.php";

require_once ABSPATH . "app/Models/Category.php";
require_once ABSPATH . "app/Repositories/CategoryRepository.php";
require_once ABSPATH . "app/Models/User.php";
require_once ABSPATH . "app/Repositories/UserRepository.php";
require_once ABSPATH . "app/Models/SubCategory.php";
require_once ABSPATH . "app/Repositories/SubCategoryRepository.php";
require_once ABSPATH . "app/Models/Course.php";
require_once ABSPATH . "app/Repositories/CourseRepository.php";
require_once ABSPATH . "app/Models/CourseGoals.php";
require_once ABSPATH . "app/Repositories/CourseGoalsRepository.php";
require_once ABSPATH . "app/Models/CourseSections.php";
require_once ABSPATH . "app/Repositories/CourseSectionsRepository.php";
require_once ABSPATH . "app/Models/CourseLectures.php";
require_once ABSPATH . "app/Repositories/CourseLecturesRepository.php";
require_once ABSPATH . "app/Models/CourseTypes.php";
require_once ABSPATH . "app/Repositories/CourseTypesRepository.php";
require_once ABSPATH . "app/Models/Wishlists.php";
require_once ABSPATH . "app/Repositories/WishListRepository.php";
require_once ABSPATH . "app/Models/Orders.php";
require_once ABSPATH . "app/Repositories/OrdersRepository.php";
require_once ABSPATH . "app/Models/Cart.php";
require_once ABSPATH . "app/Repositories/CartRepository.php";
require_once ABSPATH . "app/Models/Coupon.php";
require_once ABSPATH . "app/Repositories/CouponRepository.php";
require_once ABSPATH . "app/Models/Payments.php";
require_once ABSPATH . "app/Repositories/PaymentsRepository.php";
require_once ABSPATH . "app/Models/Questions.php";
require_once ABSPATH . "app/Repositories/QuestionsRepository.php";
require_once ABSPATH . "app/Models/Review.php";
require_once ABSPATH . "app/Repositories/ReviewRepository.php";
require_once ABSPATH . "app/Models/BlogCategories.php";
require_once ABSPATH . "app/Repositories/BlogCategoriesRepository.php";
require_once ABSPATH . "app/Models/BlogPosts.php";
require_once ABSPATH . "app/Repositories/BlogPostsRepository.php";
require_once ABSPATH . "app/Models/Notifications.php";
require_once ABSPATH . "app/Repositories/NotificationsRepository.php";
require_once ABSPATH . "app/Models/Roles.php";
require_once ABSPATH . "app/Repositories/RolesRepository.php";
require_once ABSPATH . "app/Models/Permissions.php";
require_once ABSPATH . "app/Repositories/PermissionsRepository.php";

require_once ABSPATH . "app/Models/RoleHasPermissions.php";
require_once ABSPATH . "app/Repositories/RoleHasPermissionsRepository.php";
require_once ABSPATH . "app/Models/UserHasRoles.php";


require_once ABSPATH . "Container/ServiceContainer.php";

require_once ABSPATH . "app/Services/CategoryService.php";
require_once ABSPATH . "app/Services/SubCategoryService.php";
require_once ABSPATH . "app/Services/UserService.php";
require_once ABSPATH . "app/Services/CourseService.php";
require_once ABSPATH . "app/Services/CourseGoalsService.php";
require_once ABSPATH . "app/Services/CourseSectionsService.php";
require_once ABSPATH . "app/Services/CourseLecturesService.php";
require_once ABSPATH . "app/Services/CourseTypesService.php";
require_once ABSPATH . "app/Services/OrdersService.php";
require_once ABSPATH . "app/Services/CartService.php";
require_once ABSPATH . "app/Services/CouponService.php";
require_once ABSPATH . "app/Services/PaymentsService.php";
require_once ABSPATH . "app/Services/QuestionsService.php";
require_once ABSPATH . "app/Services/ReviewService.php";
require_once ABSPATH . "app/Services/BlogCategoriesService.php";
require_once ABSPATH . "app/Services/BlogPostsService.php";
require_once ABSPATH . "app/Services/NotificationsService.php";
require_once ABSPATH . "app/Services/RolesService.php";
require_once ABSPATH . "app/Services/PermissionsService.php";
require_once ABSPATH . "app/Services/RoleHasPermissionsService.php";


//aduca.com
function get_host_name()
{
    return $_SERVER['HTTP_HOST'];
}
//http://
function getProtocol()
{
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    return $protocol;
}

//http://aduca.com
function get_domain()
{
    $protocol = getProtocol();
    return $protocol . $_SERVER['HTTP_HOST'];
}
