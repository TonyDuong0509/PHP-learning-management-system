<?php

namespace App\Services;

use App\Repositories\OrdersRepository;

class OrdersService
{
    private $orderRepository;

    public function __construct(OrdersRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAllOrders()
    {
        return $this->orderRepository->fetchAll();
    }

    public function getAllByCourseId($course_id)
    {
        return $this->orderRepository->getAllByCourseId($course_id);
    }

    public function getCourseInOrderByUserIdAndCourseId($course_id, $user_id)
    {
        $condition = "course_id = '$course_id' AND user_id = '$user_id' LIMIT 1";
        $orders =  $this->orderRepository->fetchAll($condition);
        $order = current($orders);
        return $order;
    }

    public function getAllByPaymentId($payment_id)
    {
        $condition = "payment_id = '$payment_id' ORDER BY id DESC";
        return $this->orderRepository->fetchAll($condition);
    }

    public function getOrdersLatestByPaymentIdAndInstructorId($instructor_id)
    {
        return $this->orderRepository->fetchOrdersLatestByPaymentIdAndInstructorId($instructor_id);
    }

    public function getOrdersLatestByCourseIdAndUserId($user_id)
    {
        return $this->orderRepository->fetchOrdersLatestByCourseIdAndUserId($user_id);
    }

    public function checkExist($user_id, $course_id)
    {
        return $this->orderRepository->checkExist($user_id, $course_id);
    }

    public function saveOrder($params)
    {
        return $this->orderRepository->save($params);
    }
}
