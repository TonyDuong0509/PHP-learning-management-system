<?php

namespace App\Repositories\Interfaces;

interface QuestionsRepositoryInterface
{
    public function save($params);
    public function fetchAll($condition = null);
    public function getAllByInstructorIdAndParentId($instructor_id);
    public function getById($id);
}
