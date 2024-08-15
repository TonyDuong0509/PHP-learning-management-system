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
