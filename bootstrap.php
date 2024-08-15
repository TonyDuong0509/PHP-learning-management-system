<?php
require_once ABSPATH . "app/Repositories/Interfaces/UserRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/CategoryRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/SubCategoryRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/CourseGoalsRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/CourseSectionsRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/CourseLecturesRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/CourseRepositoryInterface.php";
require_once ABSPATH . "app/Repositories/Interfaces/CourseTypesRepositoryInterface.php";

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

require_once ABSPATH . "Container/ServiceContainer.php";

require_once ABSPATH . "app/Services/CategoryService.php";
require_once ABSPATH . "app/Services/SubCategoryService.php";
require_once ABSPATH . "app/Services/UserService.php";
require_once ABSPATH . "app/Services/CourseService.php";
require_once ABSPATH . "app/Services/CourseGoalsService.php";
require_once ABSPATH . "app/Services/CourseSectionsService.php";
require_once ABSPATH . "app/Services/CourseLecturesService.php";
require_once ABSPATH . "app/Services/CourseTypesService.php";


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

//http://aduca.com/site
function get_domain_site()
{
    return get_domain() . "/site";
}
