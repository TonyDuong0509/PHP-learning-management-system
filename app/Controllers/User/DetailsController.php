<?php

namespace App\Controllers\User;

use App\Services\CategoryService;
use App\Services\CourseGoalsService;
use App\Services\CourseLecturesService;
use App\Services\CourseSectionsService;
use App\Services\CourseService;
use App\Services\SubCategoryService;
use App\Services\UserService;

class DetailsController
{
    private $courseService;
    private $courseGoalsService;
    private $sectionsService;
    private $lecturesService;
    private $userService;
    private $categoryService;
    private $subCategoryService;

    public function __construct(
        CourseService $courseService,
        CourseGoalsService $courseGoalsService,
        CourseSectionsService $sectionsService,
        CourseLecturesService $lecturesService,
        UserService $userService,
        CategoryService $categoryService,
        SubCategoryService $subCategoryService,
    ) {
        $this->courseService = $courseService;
        $this->courseGoalsService = $courseGoalsService;
        $this->sectionsService = $sectionsService;
        $this->lecturesService = $lecturesService;
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->subCategoryService = $subCategoryService;
    }

    public function index($id)
    {
        $course = $this->courseService->getById($id);
        $user = $this->userService->getByEmail($course->getInstructorEmail());
        $goals = $this->courseGoalsService->getAllByCourseId($id);
        $sections = $this->sectionsService->getSectionsByCourseId($id);
        $lectures = $this->lecturesService->getAllByCourseId($id);
        $categories = $this->categoryService->getAllCategories();
        $subCategories = [];

        for ($i = 0; $i < count($categories); $i++) {
            $category_id = $categories[$i]->getId();
            $subCategories[$category_id] = $this->subCategoryService->getByCategoryId($category_id);
        }
        $coursesSameCid = $this->courseService->getCoursesSameCid($course->getCategoryId());
        $coursesSameInstructorId = $this->courseService->getCoursesSameInstructorId($course->getInstructorId());

        require ABSPATH . 'resources/user/details/index.php';
    }
}
