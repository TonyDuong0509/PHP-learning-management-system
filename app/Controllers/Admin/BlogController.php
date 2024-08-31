<?php

namespace App\Controllers\Admin;

use App\Services\BlogCategoriesService;
use App\Services\UserService;
use DateTime;
use DateTimeZone;

class BlogController
{
    private $userService;
    private $blogCategoriesService;

    public function __construct(
        UserService $userService,
        BlogCategoriesService $blogCategoriesService,
    ) {
        $this->userService = $userService;
        $this->blogCategoriesService = $blogCategoriesService;
    }

    private function getInfoHeader()
    {
        $email = $_SESSION['admin']['email'];
        return $this->userService->getByEmail($email);
    }

    private function getDateTime()
    {
        $date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
        return $date->format('Y-m-d H:i:s');
    }

    public function allBlogCategory()
    {
        $admin = $this->getInfoHeader();
        $blogCategories = $this->blogCategoriesService->getAllBLogCategories();

        require ABSPATH . 'resources/admin/blogcategory/blogCategory.php';
    }

    public function storeBlogCategory()
    {
        $category_name = $_POST['category_name'] ?? '';
        $category_slug = strtolower(str_replace(' ', '-', $_POST['category_name']));
        $created_at = $this->getDateTime();

        $params = [
            'category_name' => $category_name,
            'category_slug' => $category_slug,
            'created_at' => $created_at,
        ];

        $this->blogCategoriesService->saveBlogCate($params);

        $_SESSION['notification'] = [
            'message' => 'BlogCategory inserted successfully',
            'alert-type' => 'success'
        ];

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function editBlogCategory($id)
    {
        $blogCategory = $this->blogCategoriesService->getById($id);

        echo json_encode($blogCategory);
        exit;
    }

    public function updateBlogCategory()
    {
        $id = $_POST['cat_id'];
        $category_name = $_POST['category_name'] ?? '';
        $category_slug = strtolower(str_replace(' ', '-', $category_name)) ?? '';
        $created_at = $this->getDateTime();

        $blogCate = $this->blogCategoriesService->getById($id);

        $params = [
            'id' => $id,
            'category_name' => $category_name,
            'category_slug' => $category_slug,
            'created_at' => $created_at,
        ];
        $blogCate['id'] = $params['id'];
        $blogCate['category_name'] = $params['category_name'];
        $blogCate['category_slug'] = $params['category_slug'];
        $blogCate['created_at'] = $params['created_at'];
        $this->blogCategoriesService->updateBlogCate($blogCate);

        $_SESSION['notification'] = [
            'message' => "Update BlogCategory successfully",
            'alert-type' => 'success'
        ];

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function deleteBlogCategory($id)
    {
        $this->blogCategoriesService->delete($id);

        $_SESSION['notification'] = [
            'message' => "Deleted BlogCategory successfully",
            'alert-type' => 'success'
        ];

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
