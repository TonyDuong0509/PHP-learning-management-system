<?php

namespace App\Controllers\Admin;

use App\Services\CategoryService;
use App\Services\CourseService;
use App\Services\SubCategoryService;
use App\Services\UserService;

class DashboardController
{
    private $userService;
    private $categoryService;
    private $subCategoryService;
    private $courseService;

    public function __construct(
        UserService $userService,
        CategoryService $categoryService,
        SubCategoryService $subCategoryService,
        CourseService $courseService
    ) {
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->subCategoryService = $subCategoryService;
        $this->courseService = $courseService;
    }

    private function getInfoHeader()
    {
        $email = $_SESSION['admin']['email'];
        return $this->userService->getByEmail($email);
    }

    public function index()
    {
        $admin = $this->getInfoHeader();

        require ABSPATH . 'resources/admin/dashboard/index.php';
    }

    public function manageInstructor()
    {
        $email = $_SESSION['admin']['email'];
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

        $params['image'] =  $this->categoryService->handleImageFile('category_image', 'image');

        $this->categoryService->saveCategory($params);
        $_SESSION['notification'] = [
            'message' => "Added Category successfully",
            'alert-type' => 'success'
        ];
        header("Location: /admin/manage-category");
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
        $_SESSION['notification'] = [
            'message' => "Added Sub Category successfully",
            'alert-type' => 'success'
        ];
        header("Location: /admin/manage-subcategory");
        exit;
    }

    public function edit($cid)
    {
        $admin = $this->getInfoHeader();
        $category = $this->categoryService->getById($cid);

        require ABSPATH . 'resources/admin/dashboard/editCategory.php';
    }

    public function editSubCategory($subCid)
    {
        $admin = $this->getInfoHeader();
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
        $image = $this->categoryService->handleImageFile('category_image', 'image', $cid, $old_image);

        $category = $this->categoryService->getById($cid);

        $category->setName($category_name);
        $category->setSlug($category_slug);
        $category->setImage($image);

        $this->categoryService->updateCategory($category);

        $_SESSION['notification'] = [
            'message' => "Updated Category successfully",
            'alert-type' => 'success'
        ];
        header("Location: /admin/edit-category/$cid");
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

        $_SESSION['notification'] = [
            'message' => "Updated Sub Category successfully",
            'alert-type' => 'success'
        ];
        header("Location: /admin/edit-subcategory/$subCid");
        exit;
    }

    public function destroy($cid)
    {
        $category = $this->categoryService->getById($cid);
        if (!empty($category->getImage())) {
            unlink($category->getImage());
        }
        $this->categoryService->deleteCategory($cid);

        $_SESSION['notification'] = [
            'message' => "Deleted Category successfully",
            'alert-type' => 'success'
        ];
        header("Location: /admin/manage-category");
        exit;
    }

    public function destroySubCategory($subCid)
    {
        $this->subCategoryService->deleteSubCategory($subCid);

        $_SESSION['notification'] = [
            'message' => "Deleted Sub Category successfully",
            'alert-type' => 'success'
        ];
        header("Location: /admin/manage-subcategory");
        exit;
    }

    public function manageCourse()
    {
        $admin = $this->getInfoHeader();
        $courses = $this->courseService->getAllCourses();
        require ABSPATH . 'resources/admin/course/allCourse.php';
    }

    public function updateCourseStatus()
    {
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);

        $courseId = $data['course_id'] ?? '';
        $isChecked = $data['is_checked'] ?? '';
        $params = [];
        $course = $this->courseService->getById($courseId);
        if ($course) {
            $course->setStatus($isChecked);
            $this->courseService->updateCourse($course);
            echo json_encode(['success' => 'Change status successfully']);
            exit;
        }
        echo json_encode(['error' => 'Something went wrong, please try again']);
        exit;
    }

    public function courseDetails($id)
    {
        $admin = $this->getInfoHeader();
        $course = $this->courseService->getById($id);

        require ABSPATH . 'resources/admin/course/details.php';
    }

    public function activeInstructor($id)
    {
        $this->userService->activeInstructor($id);

        $_SESSION['notification'] = [
            'message' => 'Active instructor successfully',
            'alert-type' => 'success',
        ];

        header("Location: /admin/manage-instructor");
        exit;
    }
}
