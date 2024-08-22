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

    public function checkExist($user_id, $course_id)
    {
        return $this->orderRepository->checkExist($user_id, $course_id);
    }

    public function saveOrder($params)
    {
        return $this->orderRepository->save($params);
    }
}
