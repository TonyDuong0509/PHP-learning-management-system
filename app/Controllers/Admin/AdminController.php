<?php

namespace App\Controllers\Admin;

use App\Services\UserService;

class AdminController
{
    private $userService;

    public function __construct(
        UserService $userService,
    ) {
        $this->userService = $userService;
    }

    private function getInfoHeader()
    {
        $email = $_SESSION['emailAdmin'];
        return $this->userService->getByEmail($email);
    }

    public function loginForm()
    {
        require ABSPATH . 'admin/login.php';
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userService->getByEmail($email);

        if (!$user) {
            $_SESSION['notification'] = [
                'message' => 'Admin not exist, please try again !',
                'alert-type' => 'error',
            ];
            header("Location: /admin/login/form");
            exit;
        }

        if (!password_verify($password, $user->getPassword())) {
            $_SESSION['notification'] = [
                'message' => 'Password is incorrect, please try again !',
                'alert-type' => 'error',
            ];
            header("Location: /admin/login/form");
            exit;
        }

        $_SESSION['emailAdmin'] = $user->getEmail();
        $_SESSION['nameAdmin'] = $user->getName();

        $_SESSION['notification'] = [
            'message' => 'Sign in successfully !',
            'alert-type' => 'success',
        ];
        header("Location: /admin/dashboard");
        exit;
    }

    public function logout()
    {
        unset($_SESSION['emailAdmin']);
        header("Location: /admin/login/form");
        exit;
    }

    public function profile($id)
    {
        $admin = $this->userService->getById($id);

        require ABSPATH . 'resources/admin/profile/profile.php';
    }

    public function storeProfile()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $old_photo = $_POST['old_photo'];
        $photo = $this->userService->handleImage('admin_image', 'photo', 'admin', $id, $old_photo);

        $admin = $this->userService->getById($id);
        $admin->setName($name);
        $admin->setUsername($username);
        $admin->setPhoto($photo);

        $this->userService->updateUser($admin);
        $_SESSION['notification'] = [
            'message' => 'Update profile successfully',
            'alert-type' => 'success'
        ];
        header("Location: /admin/profile/$id");
        exit;
    }

    public function changePassword($id)
    {
        $admin = $this->getInfoHeader();

        require ABSPATH . 'resources/admin/profile/changePassword.php';
    }

    public function updatePassword()
    {
        $id = $_POST['id'] ?? '';
        $old_password = $_POST['old_password'] ?? '';
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        $admin = $this->userService->getById($id);

        if (!password_verify($old_password, $admin->getPassword())) {
            $_SESSION['notification'] = [
                'message' => 'Old password is incorrect, please try again',
                'alert-type' => 'error',
            ];
            header("Location: /admin/change/password/$id");
            exit;
        }

        $admin->setPassword($new_password);
        $this->userService->updateUser($admin);

        $_SESSION['notification'] = [
            'message' => 'Change password successfully',
            'alert-type' => 'success',
        ];
        header("Location: /admin/change/password/$id");
        exit;
    }
}
