<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function saveUser($data)
    {
        return $this->userRepository->save($data);
    }

    public function getAllUsers()
    {
        return $this->userRepository->fetchAll();
    }

    public function getById($id)
    {
        return $this->userRepository->getById($id);
    }

    public function getByEmail($email)
    {
        return $this->userRepository->getUserByEmail($email);
    }

    public function getInstructorByRole()
    {
        return $this->userRepository->getInstructorsByRole();
    }

    public function updateUser($user)
    {
        return $this->userRepository->update($user);
    }

    public function authCheck($email)
    {
        return $this->userRepository->checkExist($email);
    }
}
