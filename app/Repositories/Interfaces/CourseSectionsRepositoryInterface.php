<?php

namespace App\Repositories\Interfaces;

interface CourseSectionsRepositoryInterface
{
    public function getSectionsByCourseId($id);
    public function fetchAll($condition = null);
    public function save($params);
    public function getById($id);
    public function update($category);
    public function delete($id);
    public function getCourseById($id);
}
