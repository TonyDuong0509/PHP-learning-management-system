<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Repositories\Interfaces\CouponRepositoryInterface;

class CouponRepository implements CouponRepositoryInterface
{
    public function save($params)
    {
        global $conn;

        $coupon_name = $params['coupon_name'];
        $coupon_discount = $params['coupon_discount'];
        $coupon_validity = $params['coupon_validity'];
        $status = 1;
        $created_at = $params['created_at'];

        $sql = "INSERT INTO coupons (coupon_name, coupon_discount, coupon_validity, status, created_at)
                VALUES ('$coupon_name', '$coupon_discount','$coupon_validity', '$status', '$created_at')";

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

        $coupons = array();
        $sql = "SELECT * FROM coupons";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $coupon = new Coupon($row['id'], $row['coupon_name'], $row['coupon_discount'], $row['coupon_validity'], $row['status'], $row['created_at']);
                $coupons[] = $coupon;
            }
        }

        return $coupons;
    }

    public function getById($id)
    {
        $condition = "id = '$id'";
        $coupons = $this->fetchAll($condition);
        $coupon = current($coupons);
        return $coupon;
    }

    public function getCouponNameAndCheckExpire($coupon_name)
    {
        $condition = "coupon_name = '$coupon_name' AND coupon_validity > " . date('Y-m-d') . " LIMIT 1";
        $coupons = $this->fetchAll($condition);
        $coupon = current($coupons);
        return $coupon;
    }

    public function update($coupon)
    {
        global $conn;

        $id = $coupon->getId();
        $coupon_name = $coupon->getCouponName();
        $coupon_discount = $coupon->getCouponDiscount();
        $coupon_validity = $coupon->getCouponValidity();
        $status = $coupon->getStatus();
        $created_at = $coupon->getCreatedAt();

        $sql = "UPDATE coupons
                SET coupon_name = '$coupon_name', coupon_discount = '$coupon_discount', coupon_validity = '$coupon_validity', status = '$status', created_at = '$created_at'
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

        $sql = "DELETE FROM coupons
                WHERE id = '$id'";

        if ($conn->query($sql) === true) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }
}
