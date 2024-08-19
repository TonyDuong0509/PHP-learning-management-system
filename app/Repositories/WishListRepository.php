<?php

namespace App\Repositories;

use App\Models\Wishlists;
use App\Repositories\Interfaces\WishListRepositoryInterface;

class WishListRepository implements WishListRepositoryInterface
{
    public function fetchAll($condition = null)
    {
        global $conn;
        $wishlists = array();

        $sql = "SELECT * FROM wishlists";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $wishList = new Wishlists($row['id'], $row['user_id'], $row['course_id'], $row['created_at']);
                $wishlists[] = $wishList;
            }
        }

        return $wishlists;
    }

    public function save($params)
    {
        global $conn;

        $user_id = $params['user_id'];
        $course_id = $params['course_id'];
        $created_at = $params['created_at'];

        $sql = "INSERT INTO wishlists (user_id, course_id, created_at)
                VALUES ('$user_id', '$course_id', '$created_at')";

        if ($conn->query($sql)) {
            $last_id = $conn->insert_id;
            return $last_id;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }

    public function checkCourseExist($id)
    {
        $condition = "course_id = '$id'";
        $wishlists = $this->fetchAll($condition);
        $wishList = current($wishlists);

        return $wishList;
    }

    public function getWishListsCourseSameUserId($user_id)
    {
        global $conn;
        $courses = array();
        $sql = "SELECT courses.*, wishlists.id as wishlist_id
                FROM wishlists
                RIGHT JOIN courses
                ON wishlists.course_id = courses.id
                WHERE wishlists.user_id = '$user_id'
                ORDER BY courses.created_at DESC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $courses[] = $row;
            }
        }

        return $courses;
    }

    public function delete($user_id, $id)
    {
        global $conn;

        $sql = "DELETE FROM wishlists
                WHERE user_id = '$user_id' AND id = '$id'";

        if ($conn->query($sql) === true) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }
}
