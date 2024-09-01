<?php

namespace App\Repositories;

use App\Models\BlogCategories;
use App\Repositories\Interfaces\BlogCategoriesRepositoryInterface;

class BlogCategoriesRepository implements BlogCategoriesRepositoryInterface
{
    public function fetchAll($condition = null)
    {
        global $conn;

        $blogCategories = array();
        $sql = "SELECT * FROM blog_categories";
        if ($condition) {
            $sql .= " WHERE $condition";
        };
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $blogCategory = new BlogCategories($row['id'], $row['category_name'], $row['category_slug'], $row['created_at']);
                $blogCategories[] = $blogCategory;
            }
        }
        return $blogCategories;
    }

    public function getAllBlogCategories()
    {
        $condition = "id != '' ORDER BY id DESC";
        return $this->fetchAll($condition);
    }

    public function getById($id)
    {
        $condition = "id = '$id'";
        $blogCategories = $this->fetchAll($condition);
        $blogCategory = current($blogCategories);
        return $blogCategory->toArray();
    }

    public function save($params)
    {
        global $conn;

        $category_name = $conn->real_escape_string($params['category_name']);
        $category_slug = $conn->real_escape_string($params['category_slug']);
        $created_at = $params['created_at'];

        $sql = "INSERT INTO blog_categories (category_name, category_slug, created_at)
                VALUES ('$category_name', '$category_slug', '$created_at')";

        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            return $last_id;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }

    public function update($blogCate)
    {
        global $conn;

        $id = $blogCate['id'];
        $category_name = $blogCate['category_name'];
        $category_slug = $blogCate['category_slug'];
        $created_at = $blogCate['created_at'];

        $sql = "UPDATE blog_categories
                SET category_name = '$category_name', category_slug = '$category_slug', created_at = '$created_at'
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

        $sql = "DELETE FROM blog_categories
                WHERE id = '$id'";
        if ($conn->query($sql) === true) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }
}
