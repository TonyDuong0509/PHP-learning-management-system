<?php

namespace App\Controllers\Instructor;

use App\Services\UserService;

class InstructorController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function dashboard()
    {
        $email = $_SESSION['instructor']['email'];

        $instructor = $this->userService->getByEmail($email);

        require ABSPATH . 'resources/instructor/dashboard/index.php';
    }

    public function registerForm()
    {
        require ABSPATH . 'instructor/registerForm.php';
    }

    public function loginForm()
    {
        require ABSPATH . 'instructor/login.php';
    }

    public function register()
    {
        $data = [];
        $data['name'] = $_POST['name'] ?? '';
        $data['username'] = $_POST['username'] ?? '';
        $data['email'] = $_POST['email'] ?? '';
        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $data['created_at'] = date('Y-m-d');
        $data['role'] = 'instructor';
        $data['status'] = 0;
        if ($this->userService->checkEmailToRegister($_POST['email'])) {
            $_SESSION['notification'] = [
                'message' => 'Email is exist, please chose another email !',
                'alert-type' => 'error',
            ];
            header("Location: /instructor/register/form");
            exit;
        }
        $this->userService->saveUser($data);
        $_SESSION['notification'] = [
            'message' => 'Register successfully, you can log in',
            'alert-type' => 'success',
        ];
        header("Location: /instructor/login/form");
        exit;
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userService->getByEmail($email);

        if ($user->getRole() !== 'instructor') {
            $_SESSION['notification'] = [
                'message' => 'This account is not authorized, please try correct account',
                'alert-type' => 'error',
            ];
            header("Location: /instructor/login/form");
            exit;
        }

        if (!$user) {
            $_SESSION['notification'] = [
                'message' => 'User not exist, please try again !',
                'alert-type' => 'error',
            ];
            header("Location: /instructor/login/form");
            exit;
        }

        if (!password_verify($password, $user->getPassword())) {
            $_SESSION['notification'] = [
                'message' => 'Password incorrect, please try again !',
                'alert-type' => 'error',
            ];
            header("Location: /instructor/login/form");
            exit;
        }

        $_SESSION['instructor'] = [
            'email' => $email,
            'name' => $user->getName(),
            'role' => $user->getRole(),
            'id' => $user->getId(),
        ];

        $_SESSION['notification'] = [
            'message' => 'Sign in successfully',
            'alert-type' => 'success',
        ];
        header("Location: /instructor/dashboard");
        exit;
    }

    public function logout()
    {
        unset($_SESSION['instructor']['email']);
        header("Location: /instructor/login/form");
        exit;
    }

    public function instructorProfile($id)
    {
        $instructor = $this->userService->getById($id);

        require ABSPATH . 'resources/instructor/profile/instructorProfile.php';
    }

    public function updateProfile()
    {
        $email = $_SESSION['instructor']['email'] ?? '';
        $instructor = $this->userService->getByEmail($email);

        $old_image = $_POST['old_photo'] ?? '';
        $name = $_POST['name'];
        $username = $_POST['username'];
        $photo = $this->userService->handleImage('instructor_image', 'photo', 'instructor', $instructor->getId(), $old_image);

        $instructor->setName($name);
        $instructor->setUsername($username);
        $instructor->setPhoto($photo);

        $this->userService->updateUser($instructor);

        $_SESSION['notification'] = [
            'message' => "Upload Image successfully",
            'alert-type' => 'success',
        ];

        header("Location: /instructor/profile/{$instructor->getId()}");
        exit;
    }

    public function editPassword($id)
    {
        $instructor = $this->userService->getById($id);

        require ABSPATH . 'resources/instructor/profile/editPassword.php';
    }

    public function changePassword()
    {
        $email = $_SESSION['instructor']['email'] ?? '';
        $instructor = $this->userService->getByEmail($email);

        $old_password = $_POST['old_password'] ?? '';
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $passwordFromDb = $instructor->getPassword();
        if (password_verify($old_password, $passwordFromDb)) {
            $instructor->setPassword($new_password);
            $this->userService->updateUser($instructor);

            $_SESSION['notification'] = [
                'message' => 'Change password successfully',
                'alert-type' => 'success',
            ];

            header("Location: /instructor/edit/password/{$instructor->getId()}");
            exit;
        } else {
            $_SESSION['notification'] = [
                'message' => 'Old password not incorrect, please try again',
                'alert-type' => 'error',
            ];

            header("Location: /instructor/edit/password/{$instructor->getId()}");
            exit;
        }
    }
}
