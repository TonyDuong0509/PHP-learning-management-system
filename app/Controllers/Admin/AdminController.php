<?php

namespace App\Controllers\Admin;

use App\Services\RoleHasPermissionsService;
use App\Services\RolesService;
use App\Services\UserService;
use DateTime;
use DateTimeZone;

class AdminController
{
    private $userService;
    private $roleService;
    private $roleHasPermissionsService;

    public function __construct(
        UserService $userService,
        RolesService $roleService,
        RoleHasPermissionsService $roleHasPermissionsService,
    ) {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->roleHasPermissionsService = $roleHasPermissionsService;
    }

    private function getInfoHeader()
    {
        $email = $_SESSION['admin']['email'];
        return $this->userService->getByEmail($email);
    }

    private function getDateTime()
    {
        $date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
        return $date->format('Y-m-d H:i:s');
    }

    public function checkPermission($requiredPermission, $role_id)
    {
        $permissions = $this->roleHasPermissionsService->getPermissionsByRoleId((int) $role_id);
        $allowedPermissions = array_column($permissions, 'guard_name');

        if (!in_array($requiredPermission, $allowedPermissions)) {
            $_SESSION['notification'] = [
                'message' => "You don't have permission to access !",
                'alert-type' => 'error',
            ];

            header("Location: /admin/dashboard");
            exit;
        }
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

        if (!in_array($user->getRole(), ['1', '2', '3'])) {
            $_SESSION['notification'] = [
                'message' => 'This account is not authorized, please input correct account',
                'alert-type' => 'error',
            ];
            header("Location: /admin/login/form");
            exit;
        }

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

        $_SESSION['admin'] = [
            'email' => $email,
            'name' => $user->getName(),
            'role' => $user->getRole(),
        ];

        $_SESSION['notification'] = [
            'message' => 'Sign in successfully !',
            'alert-type' => 'success',
        ];
        header("Location: /admin/dashboard");
        exit;
    }

    public function logout()
    {
        unset($_SESSION['admin']);
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

    public function allAdmin()
    {
        $admin = $this->getInfoHeader();
        $allAdmin = $this->userService->getAllAdminByRole();

        $this->checkPermission('Admin', $admin->getRole());

        require ABSPATH . 'resources/admin/otherAdmin/allAdmin.php';
    }

    public function addAdmin()
    {
        $admin = $this->getInfoHeader();
        $roles = $this->roleService->getAll();

        $this->checkPermission('Admin', $admin->getRole());

        require ABSPATH . 'resources/admin/otherAdmin/addAdmin.php';
    }

    public function storeAdmin()
    {
        $username = $_POST['username'] ?? '';
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $roleNum = $_POST['role'];

        $params = [
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'created_at' => $this->getDateTime(),
            'role' => $roleNum,
            'status' => 1,
        ];

        $this->userService->saveUser($params);
        $_SESSION['notification'] = [
            'message' => 'Added Admin successfully',
            'alert-type' => 'success',
        ];
        header("Location: /all/admin");
        exit;
    }

    public function editAdmin($id)
    {
        $admin = $this->userService->getById($id);
        $roles = $this->roleService->getAll();

        $this->checkPermission('Admin', $admin->getRole());

        require ABSPATH . 'resources/admin/otherAdmin/editAdmin.php';
    }

    public function updateAdmin()
    {
        $id = $_POST['id'] ?? '';
        $name = $_POST['name'] ?? '';
        $username = $_POST['username'] ?? '';
        $role = $_POST['role'] ?? '';
        $created_at = $this->getDateTime();

        $admin = $this->userService->getById($id);
        $admin->setUsername($username);
        $admin->setName($name);
        $admin->setRole($role);
        $admin->setCreatedAt($created_at);

        $this->userService->updateUser($admin);
        $_SESSION['notification'] = [
            'message' => 'Updated Admin successfully',
            'alert-type' => 'success',
        ];
        header("Location: /edit/admin/$id");
        exit;
    }

    public function deleteAdmin($id)
    {
        $this->checkPermission('Admin', $id);

        $this->userService->deleteUser($id);
        $_SESSION['notification'] = [
            'message' => 'Deleted Admin successfully',
            'alert-type' => 'success',
        ];
        header("Location: /all/admin");
        exit;
    }
}
