<?php

namespace App\Repositories;

use App\Models\Questions;
use App\Repositories\Interfaces\QuestionsRepositoryInterface;

class QuestionsRepository implements QuestionsRepositoryInterface
{
    public function fetchAll($condition = null)
    {
        global $conn;
        $questions = array();
        $sql = "SELECT * FROM questions";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $question = new Questions($row['id'], $row['course_id'], $row['user_id'], $row['instructor_id'], $row['parent_id'], $row['subject'], $row['question'], $row['created_at']);
                $questions[] = $question;
            }
        }

        return $questions;
    }

    public function getById($id)
    {
        $condition = "id = '$id'";
        $questions = $this->fetchAll($condition);
        $question = current($questions);
        return $question;
    }

    public function getAllByInstructorIdAndParentId($instructor_id)
    {
        $condition = "instructor_id = '$instructor_id' AND parent_id = 0 ORDER BY id DESC";
        return $this->fetchAll($condition);
    }

    public function save($params)
    {
        global $conn;

        $course_id = $params['course_id'] ?? '';
        $user_id = $params['user_id'] ?? '';
        $instructor_id = $params['instructor_id'] ?? '';
        $parent_id = $params['parent_id'] ?? '';
        $subject = $conn->real_escape_string($params['subject']) ?? '';
        $question = $conn->real_escape_string($params['question']) ?? '';
        $created_at = $params['created_at'] ?? '';

        $sql = "INSERT INTO questions (course_id, user_id, instructor_id, parent_id, subject, question, created_at)
                VALUES ('$course_id', '$user_id', '$instructor_id', '$parent_id', '$subject', '$question', '$created_at')";

        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            return $last_id;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }
}
