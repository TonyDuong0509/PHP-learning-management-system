<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function save($params)
    {
        global $conn;
        $course_id = $params['course_id'];
        $name = $conn->real_escape_string($params['name']);
        $qty = $params['qty'];
        $price = $params['price'];
        $weight = $params['weight'];
        $options = [
            'image' => isset($params['image']) ? $params['image'] : '',
            'slug' => isset($params['slug']) ? $params['slug'] : '',
            'instructorId' => isset($params['instructorId']) ? $params['instructorId'] : '',
        ];
        $options_json = json_encode($options);
        $sql = "INSERT INTO cart (course_id, name, qty, price, weight, options)
                VALUES ('$course_id', '$name', '$qty', '$price', '$weight', '$options_json')";

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
        $sql = "SELECT * FROM cart";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        $cartItems = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cartItems[] = [
                    'id' => $row['id'],
                    'course_id' => $row['course_id'],
                    'name' => $row['name'],
                    'qty' => $row['qty'],
                    'price' => $row['price'],
                    'weight' => $row['weight'],
                    'options' => json_decode($row['options'], true),
                ];
            }
        }

        return $cartItems;
    }

    public function total()
    {
        global $conn;
        $sql = "SELECT SUM(price * qty) as total FROM cart";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function checkExistCourse($course_id)
    {
        $condition = "course_id = '$course_id'";
        $carts = $this->fetchAll($condition);
        $cart = current($carts);
        return $cart;
    }

    public function delete($condition = null, $course_id = null)
    {
        global $conn;

        $sql = "DELETE FROM cart";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        if ($conn->query($sql) === true) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }
}
