<?php

namespace App\Repositories;

use App\Models\Orders;
use App\Repositories\Interfaces\OrdersRepositoryInterface;

class OrdersRepository implements OrdersRepositoryInterface
{
    public function fetchAll($condition = null)
    {
        global $conn;
        $orders = array();

        $sql = "SELECT * FROM orders";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $order = new Orders(
                    $row['id'],
                    $row['payment_id'],
                    $row['user_id'],
                    $row['instructor_id'],
                    $row['course_id'],
                    $row['course_title'],
                    $row['price'],
                    $row['created_at']
                );
                $orders[] = $order;
            }
        }
        return $orders;
    }

    public function fetchOrdersLatestByPaymentIdAndInstructorId($instructor_id)
    {
        global $conn;
        $orders = array();

        $subquery = "SELECT payment_id, MAX(id) as max_id
                    FROM orders
                    WHERE instructor_id = '$instructor_id'
                    GROUP BY payment_id";

        $sql = "SELECT orders.*
                FROM orders
                INNER JOIN ($subquery) AS latest_order
                ON orders.id = latest_order.max_id
                ORDER BY latest_order.max_id DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $order = new Orders(
                    $row['id'],
                    $row['payment_id'],
                    $row['user_id'],
                    $row['instructor_id'],
                    $row['course_id'],
                    $row['course_title'],
                    $row['price'],
                    $row['created_at']
                );
                $orders[] = $order;
            }
        }
        return $orders;
    }

    public function fetchOrdersLatestByCourseIdAndUserId($user_id)
    {
        global $conn;
        $orders = array();

        $subquery = "SELECT course_id, MAX(id) as max_id
                    FROM orders
                    WHERE user_id = '$user_id'
                    GROUP BY course_id";

        $sql = "SELECT orders.*
                FROM orders
                INNER JOIN ($subquery) AS latest_order
                ON orders.id = latest_order.max_id
                ORDER BY latest_order.max_id DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $order = new Orders(
                    $row['id'],
                    $row['payment_id'],
                    $row['user_id'],
                    $row['instructor_id'],
                    $row['course_id'],
                    $row['course_title'],
                    $row['price'],
                    $row['created_at']
                );
                $orders[] = $order;
            }
        }
        return $orders;
    }

    public function getAllByCourseId($course_id)
    {
        $condition = "course_id = '$course_id'";
        return $this->fetchAll($condition);
    }

    public function checkExist($user_id, $course_id)
    {
        $condition = "user_id = '$user_id' AND course_id = '$course_id' LIMIT 1";
        $orders = $this->fetchAll($condition);
        $order = current($orders);
        return $order;
    }

    public function save($params)
    {
        global $conn;

        $payment_id = $params['payment_id'];
        $user_id = $params['user_id'];
        $instructor_id = $params['instructor_id'];
        $course_id = $params['course_id'];
        $course_title = $params['course_title'];
        $price = $params['price'];
        $created_at = $params['created_at'];

        $sql = "INSERT INTO orders (payment_id, user_id, instructor_id, course_id, course_title, price, created_at)
                VALUES ('$payment_id', '$user_id', '$instructor_id', '$course_id', '$course_title', '$price', '$created_at')";

        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            return $last_id;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }
}
