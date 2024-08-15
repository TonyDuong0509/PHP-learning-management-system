<?php

namespace App\Controllers\Admin;

use App\Services\UserService;

class AuthController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register()
    {
        $data = [];
        $data['name'] = $_POST['name'] ?? '';
        $data['username'] = $_POST['username'] ?? '';
        $data['email'] = $_POST['email'] ?? '';
        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $data['created_at'] = date('Y-m-d');
        $data['role'] = 'admin';
        $data['status'] = 1;

        $user = $this->userService->saveUser($data);

        if ($user === false) {
            header('Location: registerForm.php&error=1');
            exit;
        }

        header('Location: login.php?success=1');
        exit;
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userService->getByEmail($email);

        if (!$user) {
            header("Location: login.php?error=1");
            exit;
        }

        if (!password_verify($password, $user->getPassword())) {
            header("Location: login.php?error=2");
            exit;
        }

        $_SESSION['emailAdmin'] = $user->getEmail();
        $_SESSION['nameAdmin'] = $user->getName();

        header("Location: ?c=dashboard&a=index");
        exit;
    }

    public function logout()
    {
        session_destroy();
        header("Location: login.php");
    }
}
