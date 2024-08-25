<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->fetchAll();
    }

    public function getAllCategoriesArea()
    {
        $condition = "slug != '' LIMIT 8";

        return $this->categoryRepository->fetchAll($condition);
    }

    public function saveCategory($params)
    {
        return $this->categoryRepository->save($params);
    }

    public function getById($id)
    {
        return $this->categoryRepository->getById($id);
    }

    public function getFirstById($id)
    {
        return $this->categoryRepository->getFirstById($id);
    }

    public function updateCategory($category)
    {
        return $this->categoryRepository->update($category);
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepository->delete($id);
    }

    public function handleImageFile($path, $fileName, $cid = null, $old_image = null)
    {
        if (!empty($old_image)) {
            unlink($old_image);
        }

        $targetDir = "../public/upload/$path/";
        $imageFileName = 'category_' . bin2hex(random_bytes(16)) . '.' . strtolower(pathinfo($_FILES[$fileName]['name'], PATHINFO_EXTENSION));
        $extension = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
        $targetFile = $targetDir . $imageFileName;
        $allowedExtensions = array('jpg', 'jpeg', 'png');

        if (in_array($extension, $allowedExtensions)) {
            if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $targetFile)) {
                return $targetFile;
            } else {
                $_SESSION['notification'] = [
                    'message' => "Upload image failed, please try again",
                    'alert-type' => 'error'
                ];
                header("Location: /admin/edit-category/$cid");
                exit;
            }
        } else {
            $_SESSION['notification'] = [
                'message' => "Images have to JPG, JPEG, PNG",
                'alert-type' => 'error'
            ];
            header("Location: /admin/edit-category/$cid");
            exit;
        }
    }
}
