<?php

namespace App\Repositories;

use App\Models\Review;
use App\Repositories\Interfaces\ReviewRepositoryInterface;

class ReviewRepository implements ReviewRepositoryInterface
{
    public function save($params)
    {
        global $conn;

        $course_id = $params['course_id'] ?? '';
        $user_id = $params['user_id'] ?? '';
        $instructor_id = $params['instructor_id'] ?? '';
        $comment = $conn->real_escape_string($params['comment']);
        $rating = $params['rating'] ?? '';
        $status = $params['status'] ?? '';
        $created_at = $params['created_at'] ?? '';

        $sql = "INSERT INTO reviews (course_id, user_id, instructor_id, comment, rating, status, created_at)
                VALUES ('$course_id', '$user_id', '$instructor_id', '$comment', '$rating', '$status', '$created_at')";

        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            return $last_id;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }

    public function fetchAll($condition = null)
    {
        global $conn;
        $reviews = array();

        $sql = "SELECT * FROM reviews";

        if ($condition) {
            $sql .= " WHERE $condition";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $review = new Review(
                    $row['id'],
                    $row['course_id'],
                    $row['user_id'],
                    $row['instructor_id'],
                    $row['comment'],
                    $row['rating'],
                    $row['status'],
                    $row['created_at']
                );
                $reviews[] = $review;
            }
        }
        return $reviews;
    }

    public function getAllByCourseId($course_id)
    {
        $condition = "course_id = '$course_id' ORDER BY created_at DESC LIMIT 5";
        return $this->fetchAll($condition);
    }

    public function getAllByInstructorId($instructor_id)
    {
        $condition = "instructor_id = '$instructor_id' ORDER BY id DESC";
        return $this->fetchAll($condition);
    }

    public function getAverageRatingByCourseId($course_id)
    {
        global $conn;

        $sql = "SELECT AVG(rating) as averageRating
                FROM reviews
                WHERE course_id = '$course_id' AND status = 1";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $averageRating = $row['averageRating'];
        }
        return $averageRating;
    }
}
