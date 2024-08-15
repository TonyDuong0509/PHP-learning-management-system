<?php

namespace App\Services;

use App\Repositories\CourseLecturesRepository;

class CourseLecturesService
{
    private $courseLecturesRepository;

    public function __construct(CourseLecturesRepository $courseLecturesRepository)
    {
        $this->courseLecturesRepository = $courseLecturesRepository;
    }

    public function getAllCourseLectures()
    {
        return $this->courseLecturesRepository->fetchAll();
    }

    public function getAllByCourseId($id)
    {
        $condition = "course_id = '$id' ORDER BY id DESC";

        return $this->courseLecturesRepository->fetchAll($condition);
    }

    public function getLecturesBySectionId($id)
    {
        return $this->courseLecturesRepository->getLecturesBySectionId($id);
    }

    public function saveCourseLectures($params)
    {
        return $this->courseLecturesRepository->save($params);
    }

    public function getLectureBySectionId($id)
    {
        return $this->courseLecturesRepository->getLectureBySectionId($id);
    }

    public function getById($id)
    {
        return $this->courseLecturesRepository->getById($id);
    }

    public function updateLecture($lecuture)
    {
        return $this->courseLecturesRepository->update($lecuture);
    }

    public function deleteLecture($id)
    {
        return $this->courseLecturesRepository->delete($id);
    }
}
