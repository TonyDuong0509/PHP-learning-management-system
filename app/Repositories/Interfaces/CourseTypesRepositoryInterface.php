<?php

namespace App\Repositories\Interfaces;

interface CourseTypesRepositoryInterface
{
    public function fetchAll($condition = null);
    public function getById($id);
    public function save($params);
    public function update($courseType);
    public function delete($id);
}
