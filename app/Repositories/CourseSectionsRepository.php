<?php

namespace App\Repositories;

use App\Models\CourseSections;
use App\Repositories\Interfaces\CourseSectionsRepositoryInterface;

class CourseSectionsRepository implements CourseSectionsRepositoryInterface
{
    public function fetchAll($condition = null)
    {
        global $conn;
        $courseSections = array();
        $sql = "SELECT * FROM course_sections";

        if ($condition) {
            $sql .= " WHERE $condition";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $courseSection = new CourseSections($row['id'], $row['course_id'], $row['section_title'], $row['created_at']);
                $courseSections[] = $courseSection;
            }
        }

        return $courseSections;
    }

    public function getSectionsByCourseId($id)
    {
        $condition = "course_id = '$id'";
        return $this->fetchAll($condition);
    }

    public function getById($id)
    {
        $condition = "id = '$id'";
        $sections = $this->fetchAll($condition);
        $section = current($sections);
        return $section;
    }

    public function getCourseById($id)
    {
        $condition = "course_id = '$id'";
        $sections = $this->fetchAll($condition);
        $section = current($sections);
        return $section;
    }

    public function save($params)
    {
        global $conn;

        $course_id = $params['course_id'];
        $section_title = $conn->real_escape_string($params['section_title']);
        $created_at = $params['created_at'];

        $sql = "INSERT INTO course_sections (course_id, section_title, created_at)
                VALUES ('$course_id', '$section_title', '$created_at')";

        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            return $last_id;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }

    public function update($courseSection) {}
    public function delete($id)
    {
        global $conn;

        $sql = "DELETE FROM course_sections
                WHERE id = '$id'";

        if ($conn->query($sql) === true) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }
}
