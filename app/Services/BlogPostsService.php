<?php

namespace App\Services;

use App\Repositories\BlogPostsRepository;

class BlogPostsService
{
    private $blogPostsRepository;

    public function __construct(BlogPostsRepository $blogPostsRepository)
    {
        $this->blogPostsRepository = $blogPostsRepository;
    }

    public function getAllPosts()
    {
        return $this->blogPostsRepository->getAllPosts();
    }

    public function getPostsHomeArea()
    {
        return $this->blogPostsRepository->getPostsLimit();
    }

    public function getBySlug($slug)
    {
        return $this->blogPostsRepository->getBySlug($slug);
    }

    public function getById($id)
    {
        return $this->blogPostsRepository->getById($id);
    }

    public function getAllByBlogCid($id)
    {
        return $this->blogPostsRepository->getAllByBlogCid($id);
    }

    public function savePosts($params)
    {
        return $this->blogPostsRepository->save($params);
    }

    public function handleImage($old_image = null)
    {
        if (!empty($old_image)) {
            unlink($old_image);
        }

        $targetDir = 'public/upload/posts/';
        $imageFileName = 'posts' . '_' . bin2hex(random_bytes(16)) . '.' . strtolower(pathinfo($_FILES['post_image']['name'], PATHINFO_EXTENSION));
        $extension = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
        $targetFile = $targetDir . $imageFileName;
        $allowedExtensions = array('jpg', 'jpeg', 'png');

        if (in_array($extension, $allowedExtensions)) {
            if (move_uploaded_file($_FILES['post_image']['tmp_name'], $targetFile)) {
                return $targetFile;
            } else {
                $_SESSION['notification'] = [
                    'message' => 'Upload post image failed, please try again',
                    'alert-type' => 'error',
                ];
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }
        } else {
            $_SESSION['notification'] = [
                'message' => 'Images have to JPG, JPEG, PNG please',
                'alert-type' => 'error',
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function updateBlogPost($post)
    {
        return $this->blogPostsRepository->update($post);
    }

    public function delete($id)
    {
        return $this->blogPostsRepository->delete($id);
    }
}
