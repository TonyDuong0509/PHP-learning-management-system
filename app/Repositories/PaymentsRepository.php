<?php

namespace App\Repositories;

use App\Models\Payments;
use App\Repositories\Interfaces\PaymentsRepositoryInterface;

class PaymentsRepository implements PaymentsRepositoryInterface
{
    public function save($params)
    {
        global $conn;

        $name = $params['name'];
        $email = $params['email'];
        $cash_delivery = $params['cash_delivery'];
        $total_amount = $params['total_amount'];
        $payment_type = $params['payment_type'];
        $invoice_no = $params['invoice_no'];
        $order_date = $params['order_date'];
        $order_month = $params['order_month'];
        $order_year = $params['order_year'];
        $status = $params['status'];
        $created_at = $params['created_at'];

        $sql = "INSERT INTO payments (name, email, cash_delivery, total_amount, payment_type, invoice_no, order_date, order_month, order_year, status, created_at)
                VALUES ('$name', '$email', '$cash_delivery', '$total_amount', '$payment_type', '$invoice_no', '$order_date', '$order_month', '$order_year', '$status', '$created_at')";

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
        $payments = array();

        $sql = "SELECT * FROM payments";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $payment = new Payments(
                    $row['id'],
                    $row['name'],
                    $row['email'],
                    $row['cash_delivery'],
                    $row['total_amount'],
                    $row['payment_type'],
                    $row['invoice_no'],
                    $row['order_date'],
                    $row['order_month'],
                    $row['order_year'],
                    $row['status'],
                    $row['created_at']
                );
                $payments[] = $payment;
            }
        }
        return $payments;
    }

    public function getById($id)
    {
        $condition = "id = '$id'";
        $payments = $this->fetchAll($condition);
        $payment = current($payments);
        return $payment;
    }
}
