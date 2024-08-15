<?php

namespace App\Controllers\User;

use App\Services\CategoryService;
use App\Services\CourseService;
use App\Services\CourseTypesService;
use App\Services\SubCategoryService;

class HomeController
{
    private $courseService;
    private $categoryService;
    private $courseTypesSerivce;
    private $subCategoryService;

    public function __construct(
        CourseService $courseService,
        CategoryService $categoryService,
        CourseTypesService $courseTypesSerivce,
        SubCategoryService $subCategoryService,
    ) {
        $this->courseService = $courseService;
        $this->categoryService = $categoryService;
        $this->courseTypesSerivce = $courseTypesSerivce;
        $this->subCategoryService = $subCategoryService;
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

        require ABSPATH . 'resources/user/home/index.php';
    }

    public function categoryCourse($id, $slug)
    {
        $courses = $this->courseService->getCoursesSameCid($id);
        $categoryCourse = $this->categoryService->getFirstById($id);
        $categories = $this->categoryService->getAllCategories();

        $subCategories = [];
        for ($i = 0; $i < count($categories); $i++) {
            $category_id = $categories[$i]->getId();
            $subCategories[$category_id] = $this->subCategoryService->getByCategoryId($category_id);
        }

        require ABSPATH . 'resources/user/category/categoryAll.php';
    }

    public function subCategoryCourse($id, $slug)
    {
        $courses = $this->courseService->getCoursesSameSubCid($id);
        $subCategoryCourse = $this->subCategoryService->getById($id);
        $categories = $this->categoryService->getAllCategories();

        $subCategories = [];
        for ($i = 0; $i < count($categories); $i++) {
            $category_id = $categories[$i]->getId();
            $subCategories[$category_id] = $this->subCategoryService->getByCategoryId($category_id);
        }

        require ABSPATH . 'resources/user/category/subCategoryAll.php';
    }
}
