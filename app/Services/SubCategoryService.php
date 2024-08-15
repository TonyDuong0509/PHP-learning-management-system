<?php

namespace App\Services;

use App\Repositories\SubCategoryRepository;

class SubCategoryService
{
    private $subCategoryRepository;

    public function __construct(SubCategoryRepository $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function getAllSubCategories()
    {
        return $this->subCategoryRepository->fetchAll();
    }

    public function saveSubCategory($params)
    {
        return $this->subCategoryRepository->save($params);
    }

    public function getById($id)
    {
        return $this->subCategoryRepository->getById($id);
    }

    public function getByCategoryId($cid)
    {
        return $this->subCategoryRepository->getSubCategoryByCategoryId($cid);
    }

    public function updateSubCategory($subCategory)
    {
        return $this->subCategoryRepository->update($subCategory);
    }

    public function deleteSubCategory($id)
    {
        return $this->subCategoryRepository->delete($id);
    }
}
