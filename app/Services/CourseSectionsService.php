<?php

namespace App\Services;

use App\Repositories\CourseSectionsRepository;

class CourseSectionsService
{
    private $courseSectionsRepository;

    public function __construct(CourseSectionsRepository $courseSectionsRepository)
    {
        $this->courseSectionsRepository = $courseSectionsRepository;
    }

    public function getAllCourseSections()
    {
        return $this->courseSectionsRepository->fetchAll();
    }

    public function getSectionsByCourseId($id)
    {
        return $this->courseSectionsRepository->getSectionsByCourseId($id);
    }

    public function getById($id)
    {
        return $this->courseSectionsRepository->getById($id);
    }

    public function saveCourseSections($params)
    {
        return $this->courseSectionsRepository->save($params);
    }

    public function getCourseById($id)
    {
        return $this->courseSectionsRepository->getCourseById($id);
    }

    public function deleteSection($id)
    {
        return $this->courseSectionsRepository->delete($id);
    }
}
