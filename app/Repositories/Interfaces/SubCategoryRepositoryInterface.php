<?php

namespace App\Repositories\Interfaces;

interface SubCategoryRepositoryInterface
{
    public function getSubCategoryByCategoryId($cid);
    public function fetchAll($condition = null);
    public function save($params);
    public function getById($id);
    public function update($category);
    public function delete($id);
}
