<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getUserByEmail($email);
    public function getInstructorsByRole();
    public function fetchAll($condition = null);
    public function save($params);
    public function getById($id);
    public function update($category);
    public function delete($id);
    public function checkExist($email);
    public function activeInstructor($id);
}
