<?php

namespace App\Repositories;

use App\Models\CourseTypes;
use App\Repositories\Interfaces\CourseTypesRepositoryInterface;

class CourseTypesRepository implements CourseTypesRepositoryInterface
{
    public function fetchAll($condition = null)
    {
        global $conn;

        $types = array();
        $sql = "SELECT * FROM course_types";

        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $type = new CourseTypes($row['id'], $row['title']);
                $types[] = $type;
            }
        }

        return $types;
    }

    public function getById($id) {}

    public function save($params)
    {
        global $conn;
        $title = $params['title'];
        $sql = "INSERT INTO course_types (title)
                VALUES ('$title')";

        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            return $last_id;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }

    public function update($courseType)
    {
        global $conn;
        $id = $courseType->getId();
        $title = $courseType->getTitle();
        $sql = "UPDATE course_types
                SET title = '$title'
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

        $sql = "DELETE FROM course_types
                WHERE id = '$id'";

        if ($conn->query($sql) === true) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }
}
