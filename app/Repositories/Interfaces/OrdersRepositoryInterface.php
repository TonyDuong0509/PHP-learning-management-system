<?php

namespace App\Repositories\Interfaces;

interface OrdersRepositoryInterface
{
    public function fetchAll($condition = null);
    public function checkExist($user_id, $course_id);
    public function save($params);
}
