<?php

namespace App\Repositories\Interfaces;

interface BlogCategoriesRepositoryInterface
{
    public function save($params);
    public function fetchAll($condition = null);
    public function getAllBlogCategories();
    public function getById($id);
    public function update($blogCate);
    public function delete($id);
}
