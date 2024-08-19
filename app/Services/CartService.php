<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\CourseRepository;

class CartService
{
    private $cartRepository;

    public function __construct(
        CartRepository $cartRepository,
    ) {
        $this->cartRepository = $cartRepository;
    }

    public function saveCart($params)
    {
        return $this->cartRepository->save($params);
    }

    public function checkExistCourse($id)
    {
        return $this->cartRepository->checkExistCourse($id);
    }

    public function getAll()
    {
        $condition = "id != '' ORDER BY id ASC";

        return $this->cartRepository->fetchAll($condition);
    }

    public function total()
    {
        return $this->cartRepository->total();
    }

    public function delete($course_id)
    {
        return $this->cartRepository->delete($course_id);
    }
}
