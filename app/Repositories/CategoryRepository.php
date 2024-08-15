<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function fetchAll($condition = null)
    {
        global $conn;
        $categories = array();
        $sql = "SELECT * FROM categories";
        if ($condition) {
            $sql .= " WHERE $condition";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $category = new Category($row['id'], $row['name'], $row['slug'], $row['created_at'], $row['image']);
                $categories[] = $category;
            }
        }
        return $categories;
    }

    public function save($params)
    {
        global $conn;

        $name = $params['name'];
        $slug = $params['slug'];
        $created_at = $params['created_at'];
        $image = $params['image'];

        $sql = "INSERT INTO categories (name, slug, created_at, image)
                VALUES ('$name', '$slug', '$created_at', '$image')";

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
        $categories = $this->fetchAll($condition);
        $category = current($categories);
        return $category;
    }

    public function getFirstById($id)
    {
        $condition = "id = '$id' LIMIT 1";
        $categories = $this->fetchAll($condition);
        $category = current($categories);
        return $category;
    }

    public function update($category)
    {
        global $conn;
        $id = $category->getId();
        $category_name = $category->getName();
        $category_slug = $category->getSlug();
        $image = $category->getImage();

        $sql = "UPDATE categories 
                SET name = '$category_name', slug = '$category_slug', image = '$image'
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

        $sql = "DELETE FROM categories
                WHERE id = '$id'";

        if ($conn->query($sql) === true) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }
}
