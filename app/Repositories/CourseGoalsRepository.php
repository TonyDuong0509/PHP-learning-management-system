<?php

namespace App\Repositories;

use App\Models\CourseGoals;
use App\Repositories\Interfaces\CourseGoalsRepositoryInterface;

class CourseGoalsRepository implements
    CourseGoalsRepositoryInterface
{
    public function fetchAll($condition = null)
    {
        global $conn;

        $courseGoals = array();
        $sql = "SELECT * FROM course_goals";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $courseGoal = new CourseGoals($row['id'], $row['course_id'], $row['goal_name'], $row['created_at']);
                $courseGoals[] = $courseGoal;
            }
        }

        return $courseGoals;
    }

    public function getAllByCourseId($id)
    {
        $condition = "course_id = '$id'";

        return $this->fetchAll($condition);
    }

    public function save($params)
    {
        global $conn;

        $course_id = $conn->real_escape_string($params['course_id']);
        $goal_name = $conn->real_escape_string($params['goal_name']);
        $created_at = $conn->real_escape_string($params['created_at']);

        $sql = "INSERT INTO course_goals (course_id, goal_name, created_at)
                VALUES ('$course_id', '$goal_name', '$created_at')";

        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            return $last_id;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }

    public function delete($id)
    {
        global $conn;

        $sql = "DELETE FROM course_goals WHERE course_id = '$id'";
        if ($conn->query($sql)) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }

    public function getById($id) {}

    public function update($courseGoals) {}
}
