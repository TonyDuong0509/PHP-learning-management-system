<?php

namespace App\Services;

use App\Repositories\CourseTypesRepository;

class CourseTypesService
{
    private $courseTypesRepository;

    public function __construct(CourseTypesRepository $courseTypesRepository)
    {
        $this->courseTypesRepository = $courseTypesRepository;
    }

    public function getAllTypes()
    {
        return $this->courseTypesRepository->fetchAll();
    }

    public function getById($id)
    {
        return $this->courseTypesRepository->getById($id);
    }

    public function saveTypes($params)
    {
        return $this->courseTypesRepository->save($params);
    }

    public function updateTypes($courseType)
    {
        return $this->courseTypesRepository->update($courseType);
    }

    public function deleteTypes($id)
    {
        return $this->courseTypesRepository->delete($id);
    }
}
