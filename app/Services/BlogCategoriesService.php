<?php

namespace App\Services;

use App\Repositories\BlogCategoriesRepository;

class BlogCategoriesService
{
    private $blogCategoryRepository;

    public function __construct(BlogCategoriesRepository $blogCategoriesRepository)
    {
        $this->blogCategoryRepository = $blogCategoriesRepository;
    }

    public function saveBlogCate($params)
    {
        return $this->blogCategoryRepository->save($params);
    }

    public function getAllBLogCategories()
    {
        return $this->blogCategoryRepository->getAllBLogCategories();
    }

    public function getById($id)
    {
        return $this->blogCategoryRepository->getById($id);
    }

    public function updateBlogCate($blogCate)
    {
        return $this->blogCategoryRepository->update($blogCate);
    }

    public function delete($id)
    {
        return $this->blogCategoryRepository->delete($id);
    }
}
