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
        $email = $_SESSION['emailInstructor'];

        $instructor = $this->userService->getByEmail($email);

        require ABSPATH . 'resources/instructor/dashboard/index.php';
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

        $_SESSION['emailInstructor'] = $user->getEmail();
        $_SESSION['nameInstructor'] = $user->getName();
        $_SESSION['idInstructor'] = $user->getId();

        header("Location: ?c=instructor&a=dashboard");
        exit;
    }

    public function logout()
    {
        session_destroy();
        header("Location: login.php");
        exit;
    }
}
