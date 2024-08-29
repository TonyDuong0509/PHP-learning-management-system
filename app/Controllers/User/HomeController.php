<?php

namespace App\Controllers\User;

use App\Services\CategoryService;
use App\Services\CourseService;
use App\Services\CourseTypesService;
use App\Services\OrdersService;
use App\Services\ReviewService;
use App\Services\SubCategoryService;

class HomeController
{
    private $courseService;
    private $categoryService;
    private $courseTypesSerivce;
    private $subCategoryService;
    private $reviewService;
    private $orderService;

    public function __construct(
        CourseService $courseService,
        CategoryService $categoryService,
        CourseTypesService $courseTypesSerivce,
        SubCategoryService $subCategoryService,
        ReviewService $reviewService,
        OrdersService $orderService,
    ) {
        $this->courseService = $courseService;
        $this->categoryService = $categoryService;
        $this->courseTypesSerivce = $courseTypesSerivce;
        $this->subCategoryService = $subCategoryService;
        $this->reviewService = $reviewService;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $courseTypes = $this->courseTypesSerivce->getAllTypes();
        $courses = $this->courseService->getAllCourses();
        $categories = $this->categoryService->getAllCategories();
        $categoriesArea = $this->categoryService->getAllCategoriesArea();
        $subCategories = [];
        for ($i = 0; $i < count($categories); $i++) {
            $category_id = $categories[$i]->getId();
            $subCategories[$category_id] = $this->subCategoryService->getByCategoryId($category_id);
        }
        $reviews = $this->reviewService->getAllByCourseId($courses[0]->getId());
        $averageRating = $this->reviewService->getAverageRatingByCourseId($courses[0]->getId());
        $enrollmentStudents = $this->orderService->getAllByCourseId($courses[0]->getId());

        require ABSPATH . 'resources/user/home/index.php';
    }
}
