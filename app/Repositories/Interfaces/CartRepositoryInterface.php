<?php

namespace App\Repositories\Interfaces;

interface CartRepositoryInterface
{
    public function save($params);
    public function fetchAll($condition = null);
    public function checkExistCourse($id);
    public function total();
    public function delete($condition = null, $course_id = null);
}
