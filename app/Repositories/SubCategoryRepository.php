<?php

namespace App\Repositories;

use App\Models\SubCategory;
use App\Repositories\Interfaces\SubCategoryRepositoryInterface;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    public function fetchAll($condition = null)
    {
        global $conn;
        $subCategories = array();
        $sql = "SELECT * FROM sub_categories";
        if ($condition) {
            $sql .= " WHERE $condition";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $subcategory = new SubCategory($row['id'], $row['category_id'], $row['name'], $row['slug'], $row['created_at']);
                $subCategories[] = $subcategory;
            }
        }
        return $subCategories;
    }

    public function save($params)
    {
        global $conn;

        $name = $params['name'];
        $slug = $params['slug'];
        $category_id = $params['category_id'];
        $created_at = $params['created_at'];

        $sql = "INSERT INTO sub_categories (category_id, name, slug, created_at)
                VALUES ('$category_id', '$name', '$slug', '$created_at')";

        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            return $last_id;
        }

        echo "Error: " . $sql . PHP_EOL;
        return false;
    }

    public function getById($id)
    {
        $condition = "id = '$id'";
        $subCategories = $this->fetchAll($condition);
        $subCategory = current($subCategories);
        return $subCategory;
    }

    public function getSubCategoryByCategoryId($cid)
    {
        $condition = "category_id = '$cid'";
        return $this->fetchAll($condition);
    }

    public function update($subCategory)
    {
        global $conn;
        $id = $subCategory->getId();
        $subCategory_name = $subCategory->getName();
        $subCategory_slug = $subCategory->getSlug();
        $category_id = $subCategory->getCategoryId();

        $sql = "UPDATE sub_categories 
                SET category_id = '$category_id', name = '$subCategory_name', slug = '$subCategory_slug'
                WHERE id = '$id'";

        if ($conn->query($sql) === true) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }

    public function delete($id)
    {
        global $conn;

        $sql = "DELETE FROM sub_categories
                WHERE id = '$id'";

        if ($conn->query($sql) === true) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }
}
