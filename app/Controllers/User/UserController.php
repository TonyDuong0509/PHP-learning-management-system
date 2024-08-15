<?php

namespace App\Controllers\User;

use App\Services\UserService;

class UserController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function registerForm()
    {
        require ABSPATH . 'resources/user/auth/registerForm.php';
    }

    public function loginForm()
    {
        require ABSPATH . 'resources/user/auth/loginForm.php';
    }

    public function register()
    {
        $data = [];
        $data['name'] = $_POST['name'] ?? '';
        $data['username'] = $_POST['username'] ?? '';
        $data['email'] = $_POST['email'] ?? '';
        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $data['created_at'] = date('Y-m-d');
        $data['role'] = 'user';
        $data['status'] = 0;

        $this->userService->saveUser($data);

        // Check email exist

        global $router;
        header("Location: {$router->generate('login')}?success=1");
        exit;
    }

    public function login()
    {
        global $router;

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userService->getByEmail($email);

        if (!$user) {
            header("Location: {$router->generate('login')}?error=1");
            exit;
        }

        if (!password_verify($password, $user->getPassword())) {
            header("Location: {$router->generate('login')}?error=2");
            exit;
        }

        $_SESSION['emailUser'] = $user->getEmail();
        $_SESSION['nameUser'] = $user->getName();

        header("Location: /");
        exit;
    }

    public function logout()
    {
        session_destroy();
        header("Location: /");
        exit;
    }
}
