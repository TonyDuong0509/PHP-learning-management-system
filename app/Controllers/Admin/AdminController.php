<?php

namespace App\Controllers\Admin;

use App\Services\UserService;

class AdminController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    private function getInfoHeader()
    {
        $email = $_SESSION['emailAdmin'];
        return $this->userService->getByEmail($email);
    }

    public function profile()
    {
        $admin = $this->getInfoHeader();

        require ABSPATH . 'resources/admin/profile/profile.php';
    }

    public function storeProfile()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $old_photo = $_POST['old_photo'];

        if (!empty($old_photo)) {
            unlink($old_photo);
        }

        $targetDir = '../public/upload/admin_image/';
        $imageFileName = 'admin' . bin2hex(random_bytes(16)) . '.' . strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $extension = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
        $targetFile = $targetDir . $imageFileName;
        $allowedExtensions = array('jpg', 'jpeg', 'png');

        if (in_array($extension, $allowedExtensions)) {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
                $photo = $targetFile;
            } else {
                header("Location: ?c=admin&a=profile&error=1");
                exit;
            }
        } else {
            header("Location: ?c=admin&a=profile&error=2");
            exit;
        }

        $admin = $this->userService->getById($id);
        $admin->setName($name);
        $admin->setUsername($username);
        $admin->setPhoto($photo);

        $this->userService->updateUser($admin);
        header("Location: ?c=admin&a=profile&success=1");
        exit;
    }

    public function changePassword()
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
            header("Location: ?c=admin&a=changepassword&error=1");
            exit;
        }

        $admin->setPassword($new_password);
        $this->userService->updateUser($admin);

        header("Location: ?c=admin&a=changepassword&success=1");
        exit;
    }
}
