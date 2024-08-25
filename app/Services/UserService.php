<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;

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

    public function checkEmailToRegister($email)
    {
        return $this->userRepository->checkEmailToRegister($email);
    }

    public function handleImage($path, $filePathName, $instance, $id, $old_image = null)
    {
        if (!empty($old_image)) {
            unlink($old_image);
        }

        $targetDir = "public/upload/$path/";
        $imageFileName = 'user' . '_' . bin2hex(random_bytes(16)) . '.' . strtolower(pathinfo($_FILES[$filePathName]['name'], PATHINFO_EXTENSION));
        $extension = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
        $targetFile = $targetDir . $imageFileName;
        $allowedExtensions = array('jpg', 'jpeg', 'png');
        if (in_array($extension, $allowedExtensions)) {
            if (move_uploaded_file($_FILES[$filePathName]['tmp_name'], $targetFile)) {
                return $targetFile;
            } else {
                $_SESSION['notification'] = [
                    'message' => "Upload image failed, please try again",
                    'alert-type' => 'error',
                ];
                header("Location: /$instance/profile/$id");
                exit;
            }
        } else {
            $_SESSION['notification'] = [
                'message' => "Image have to JPG, JPEG, PNG",
                'alert-type' => 'error',
            ];
            header("Location: /$instance/profile/$id");
            exit;
        }
    }

    public function activeInstructor($id)
    {
        return $this->userRepository->activeInstructor($id);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
