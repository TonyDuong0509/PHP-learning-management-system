<?php

namespace App\Repositories\Interfaces;

interface ReviewRepositoryInterface
{
    public function save($params);
    public function fetchAll($condition = null);
    public function getAllByCourseId($course_id);
    public function getAverageRatingByCourseId($course_id);
    public function getAllByInstructorId($instructor_id);
}
