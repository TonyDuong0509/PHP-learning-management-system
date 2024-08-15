<?php

namespace App\Controllers\Admin;

use App\Services\CategoryService;
use App\Services\SubCategoryService;
use App\Services\UserService;

class DashboardController
{
    private $userService;
    private $categoryService;
    private $subCategoryService;

    public function __construct(
        UserService $userService,
        CategoryService $categoryService,
        SubCategoryService $subCategoryService
    ) {
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->subCategoryService = $subCategoryService;
    }

    private function getInfoHeader()
    {
        $email = $_SESSION['emailAdmin'];
        return $this->userService->getByEmail($email);
    }

    public function index()
    {
        $admin = $this->getInfoHeader();

        require ABSPATH . 'resources/admin/dashboard/index.php';
    }

    public function manageInstructor()
    {
        $email = $_SESSION['emailAdmin'];
        $admin = $this->userService->getByEmail($email);
        $instructors = $this->userService->getInstructorByRole();

        require ABSPATH . 'resources/admin/dashboard/manageInstructor.php';
    }

    public function manageCategory()
    {
        $admin = $this->getInfoHeader();
        $categories = $this->categoryService->getAllCategories();

        require ABSPATH . 'resources/admin/dashboard/manageCategory.php';
    }

    public function manageSubCategory()
    {
        $admin = $this->getInfoHeader();
        $subCategories = $this->subCategoryService->getAllSubCategories();

        require ABSPATH . 'resources/admin/dashboard/manageSubCategory.php';
    }

    public function addCategory()
    {
        $admin = $this->getInfoHeader();

        require ABSPATH . 'resources/admin/dashboard/addCategory.php';
    }

    public function addSubCategory()
    {
        $admin = $this->getInfoHeader();
        $categories = $this->categoryService->getAllCategories();

        require ABSPATH . 'resources/admin/dashboard/addSubCategory.php';
    }

    public function storeCategory()
    {
        $params = [
            'name' => $_POST['category_name'] ?? '',
            'slug' => strtolower(str_replace(' ', '-', $_POST['category_name'])),
            'created_at' => date('Y-m-d'),
        ];

        $params['image'] =  $this->categoryService->handleImageFile('category_image', 'image', 'dashboard', 'addCategory');

        $this->categoryService->saveCategory($params);

        header("Location: ?c=dashboard&a=manageCategory");
        exit;
    }

    public function storeSubCategory()
    {
        $params = [
            'name' => $_POST['subcategory_name'] ?? '',
            'category_id' => $_POST['category_id'],
            'slug' => strtolower(str_replace(' ', '-', $_POST['subcategory_name'])),
            'created_at' => date('Y-m-d'),
        ];

        $this->subCategoryService->saveSubCategory($params);

        header("Location: ?c=dashboard&a=manageSubCategory");
        exit;
    }

    public function edit()
    {
        $admin = $this->getInfoHeader();
        $cid = $_GET['cid'] ?? '';
        $category = $this->categoryService->getById($cid);

        require ABSPATH . 'resources/admin/dashboard/editCategory.php';
    }

    public function editSubCategory()
    {
        $admin = $this->getInfoHeader();
        $subCid = $_GET['subCid'] ?? '';
        $categories = $this->categoryService->getAllCategories();
        $subCategory = $this->subCategoryService->getById($subCid);

        require ABSPATH . 'resources/admin/dashboard/editSubCategory.php';
    }

    public function updateCategory()
    {
        $cid = $_POST['cid'];
        $old_image = $_POST['old_image'];
        $category_name = $_POST['category_name'];
        $category_slug = strtolower(str_replace(' ', '-', $_POST['category_name']));
        $image = $this->categoryService->handleImageFile('category_image', 'image', 'dashboard', 'edit', $old_image);

        $category = $this->categoryService->getById($cid);

        $category->setName($category_name);
        $category->setSlug($category_slug);
        $category->setImage($image);

        $this->categoryService->updateCategory($category);

        header("Location: ?c=dashboard&a=edit&cid=$cid&success=1");
        exit;
    }

    public function updateSubCategory()
    {
        $subCid = $_POST['subCid'];
        $subCategory_name = $_POST['subCategory_name'];
        $subCategory_slug = strtolower(str_replace(' ', '-', $_POST['subCategory_name']));
        $category_id = $_POST['category_id'];

        $subCategory = $this->subCategoryService->getById($subCid);

        $subCategory->setName($subCategory_name);
        $subCategory->setSlug($subCategory_slug);
        $subCategory->setCategoryId($category_id);

        $this->subCategoryService->updateSubCategory($subCategory);

        header("Location: ?c=dashboard&a=editSubCategory&subCid=$subCid&success=1");
        exit;
    }

    public function destroy()
    {
        $cid = $_GET['cid'];

        $category = $this->categoryService->getById($cid);
        if (!empty($category->getImage())) {
            unlink($category->getImage());
        }
        $this->categoryService->deleteCategory($cid);

        header("Location: ?c=dashboard&a=manageCategory&success=1");
        exit;
    }

    public function destroySubCategory()
    {
        $subCid = $_GET['subCid'];

        $this->subCategoryService->deleteSubCategory($subCid);

        header("Location: ?c=dashboard&a=manageSubCategory&success=1");
        exit;
    }
}
