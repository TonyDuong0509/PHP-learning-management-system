<?php

namespace App\Services;

use App\Repositories\CourseGoalsRepository;

class CourseGoalsService
{
    private $courseGoalsRepository;

    public function __construct(CourseGoalsRepository $courseGoalsRepository)
    {
        $this->courseGoalsRepository = $courseGoalsRepository;
    }

    public function GetAllCourseGoals()
    {
        return $this->courseGoalsRepository->fetchAll();
    }

    public function getAllByCourseId($id)
    {
        return $this->courseGoalsRepository->getAllByCourseId($id);
    }

    public function saveCourseGoals($params)
    {
        return $this->courseGoalsRepository->save($params);
    }

    public function deleteCourseGoals($id)
    {
        return $this->courseGoalsRepository->delete($id);
    }
}
