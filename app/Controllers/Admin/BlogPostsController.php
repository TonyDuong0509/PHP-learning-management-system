<?php

namespace App\Controllers\Admin;

use App\Services\BlogCategoriesService;
use App\Services\BlogPostsService;
use App\Services\CategoryService;
use App\Services\SubCategoryService;
use App\Services\UserService;
use DateTime;
use DateTimeZone;

class BlogPostsController
{
    private $userSerivce;
    private $blogPostsService;
    private $blogCategoriesService;
    private $categoryService;
    private $subCategoryService;

    public function __construct(
        UserService $userSerivce,
        BlogPostsService $blogPostsService,
        BlogCategoriesService $blogCategoriesService,
        CategoryService $categoryService,
        SubCategoryService $subCategoryService,
    ) {
        $this->userSerivce = $userSerivce;
        $this->blogPostsService = $blogPostsService;
        $this->blogCategoriesService = $blogCategoriesService;
        $this->categoryService = $categoryService;
        $this->subCategoryService = $subCategoryService;
    }

    private function getInfoHeader()
    {
        $email = $_SESSION['admin']['email'];
        return $this->userSerivce->getByEmail($email);
    }

    private function getDateTime()
    {
        $date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
        return $date->format('Y-m-d H:i:s');
    }

    public function blogPosts()
    {
        $admin = $this->getInfoHeader();
        $blogPosts = $this->blogPostsService->getAllPosts();

        require ABSPATH . 'resources/admin/blogposts/allPosts.php';
    }

    public function addBlogPosts()
    {
        $admin = $this->getInfoHeader();
        $blogCategories = $this->blogCategoriesService->getAllBLogCategories();

        require ABSPATH . 'resources/admin/blogposts/addPosts.php';
    }

    public function storeBlogPosts()
    {
        $blogcategory_id = $_POST['blogcategory_id'];
        $post_title = $_POST['post_title'];
        $post_slug = strtolower(str_replace(' ', '-', $post_title));
        $description = $_POST['description'];
        $post_tags = $_POST['post_tags'];
        $created_at = $this->getDateTime();

        $params = [
            'blogcategory_id' => $blogcategory_id,
            'post_title' => $post_title,
            'post_slug' => $post_slug,
            'description' => $description,
            'post_tags' => $post_tags,
            'created_at' => $created_at,
            'post_image' => $this->blogPostsService->handleImage(),
        ];

        $this->blogPostsService->savePosts($params);

        $_SESSION['notification'] = [
            'message' => 'Added post image successfully',
            'alert-type' => 'success',
        ];
        header("Location: /blog/posts");
        exit;
    }

    public function editBlogPosts($id)
    {
        $admin = $this->getInfoHeader();
        $blogPost = $this->blogPostsService->getById($id);
        $blogCategories = $this->blogCategoriesService->getAllBLogCategories();

        require ABSPATH . 'resources/admin/blogposts/editPosts.php';
    }

    public function updateBlogPosts()
    {
        $id = $_POST['id'];
        $old_image = $_POST['old_image'];
        $blogcategory_id = $_POST['blogcategory_id'];
        $post_title = $_POST['post_title'];
        $post_slug = strtolower(str_replace(' ', '-', $post_title));
        $description = $_POST['description'];
        $post_tags = $_POST['post_tags'];
        $post_image = $this->blogPostsService->handleImage($old_image);
        $created_at = $this->getDateTime();

        $post = $this->blogPostsService->getById($id);
        $post->setBlogcategoryId($blogcategory_id);
        $post->setPostTitle($post_title);
        $post->setPostSlug($post_slug);
        $post->setDescription($description);
        $post->setPostTags($post_tags);
        $post->setPostImage($post_image);
        $post->setCreatedAt($created_at);

        $this->blogPostsService->updateBlogPost($post);

        $_SESSION['notification'] = [
            'message' => 'Upload Blog Post successfully',
            'alert-type' => 'success',
        ];
        header("Location: /edit/blog/posts/$id");
        exit;
    }

    public function deleteBlogPosts($id)
    {
        $post = $this->blogPostsService->getById($id);
        if (!empty($post->getPostImage())) {
            unlink($post->getPostImage());
        }

        $this->blogPostsService->delete($id);

        $_SESSION['notification'] = [
            'message' => 'Deleted Blog Post successfully',
            'alert-type' => 'success',
        ];
        header("Location: /blog/posts");
        exit;
    }

    public function blogDetails($slug)
    {
        $blogPost = $this->blogPostsService->getBySlug($slug);
        $tag = $blogPost->getPostTags();
        $all_tags = explode(',', $tag);
        $posts = $this->blogPostsService->getPostsHomeArea();
        $blogCategories = $this->blogCategoriesService->getAllBLogCategories();

        require ABSPATH . 'resources/user/blog/blogDetails.php';
    }

    public function blogCategoryList($id)
    {
        $blogPosts = $this->blogPostsService->getAllByBlogCid($id);
        $breadCategory = $this->blogCategoriesService->getById($blogPosts[0]->getBlogcategoryId());
        $blogCategories = $this->blogCategoriesService->getAllBLogCategories();
        $posts = $this->blogPostsService->getAllPosts();

        require ABSPATH . 'resources/user/blog/blogCategoryList.php';
    }

    public function allBlogPosts()
    {
        $categories = $this->categoryService->getAllCategories();

        $subCategories = [];
        for ($i = 0; $i < count($categories); $i++) {
            $category_id = $categories[$i]->getId();
            $subCategories[$category_id] = $this->subCategoryService->getByCategoryId($category_id);
        }
        $blogPosts = $this->blogPostsService->getAllPosts();

        require ABSPATH . 'resources/user/blog/allBlog.php';
    }
}
