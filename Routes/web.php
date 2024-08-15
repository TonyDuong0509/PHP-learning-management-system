<?php

use Container\ServiceContainer;

$router = new AltoRouter();

$serviceContainer = new ServiceContainer();

// User routes
$router->map('GET', '/', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\HomeController::class);
    $controller->index();
}, 'home');

$router->map('GET', '/course-details/[i:id].html', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\DetailsController::class);
    $controller->index($id);
}, 'course.details');

$router->map('GET', '/category/[i:id]/[*:slug].html', function ($id, $slug) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\HomeController::class);
    $controller->categoryCourse($id, $slug);
}, 'course.category');

$router->map('GET', '/subcategory/[i:id]/[*:slug].html', function ($id, $slug) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\HomeController::class);
    $controller->subCategoryCourse($id, $slug);
}, 'course.subCategory');

$router->map('GET', '/register.html', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->registerForm();
}, 'register');

$router->map('GET', '/login.html', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->loginForm();
}, 'login');

$router->map('GET', '/logout', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\User\UserController::class);
    $controller->logout();
}, 'logout');



// Instructor routes
$router->map('GET', '/instructor/dashboard.html', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\InstructorController::class);
    $controller->dashboard();
}, 'dashboard');

$router->map('GET', '/instructor/courses.html', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->manageCourse();
}, 'all.course');

$router->map('GET', '/instructor/add-course.html', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->addCourse();
}, 'add.course');

$router->map('GET', '/instructor/edit-course/[i:id].html', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->editCourse($id);
}, 'edit.course');

$router->map('GET', '/instructor/add-course-lecture/[i:id].html', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->addCourseLecture($id);
}, 'add.course.lecture');

$router->map('GET', '/instructor/edit-course-lecture/[i:id].html', function ($id) use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\CourseController::class);
    $controller->editCourseLecture($id);
}, 'edit.course.lecture');

$router->map('GET', '/instructor/logout.html', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(App\Controllers\Instructor\InstructorController::class);
    $controller->logout();
}, 'instructor.logout');

$match = $router->match();
$routeName = is_array($match) ? ($match['name'] ?? null) : null;
