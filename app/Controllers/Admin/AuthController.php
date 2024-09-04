<?php

namespace App\Controllers\Admin;

use App\Services\PermissionsService;
use App\Services\RoleHasPermissionsService;
use App\Services\RolesService;
use App\Services\UserService;

class AuthController
{
  private $userService;
  private $permissionsService;
  private $rolesService;
  private $roleHasPermissionsService;

  public function __construct(
    UserService $userService,
    PermissionsService $permissionsService,
    RolesService $rolesService,
    RoleHasPermissionsService $roleHasPermissionsService,
  ) {
    $this->userService = $userService;
    $this->permissionsService = $permissionsService;
    $this->rolesService = $rolesService;
    $this->roleHasPermissionsService = $roleHasPermissionsService;
  }

  private function getInfoHeader()
  {
    $email = $_SESSION['admin']['email'];
    return $this->userService->getByEmail($email);
  }

  public function allPermissions()
  {
    $admin = $this->getInfoHeader();
    $permissions = $this->permissionsService->getAll();

    require ABSPATH . 'resources/admin/auth/allPermission.php';
  }

  public function addPermission()
  {
    $admin = $this->getInfoHeader();

    require ABSPATH . 'resources/admin/auth/addPermission.php';
  }

  public function storePermission()
  {
    $name = $_POST['name'] ?? '';
    $guard_name = $_POST['group_name'] ?? '';

    $params = [
      'name' => $name,
      'guard_name' => $guard_name,
    ];
    $this->permissionsService->save($params);
    $_SESSION['notifications'] = [
      'message' => 'Added Permission successfully',
      'alert-type' => 'success'
    ];

    header("Location: /all/permission");
    exit;
  }

  public function editPermission($id)
  {
    $admin = $this->getInfoHeader();
    $permission = $this->permissionsService->getById($id);

    require ABSPATH . 'resources/admin/auth/editPermission.php';
  }

  public function updatePermission()
  {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $guard_name = $_POST['group_name'] ?? '';

    $permission = $this->permissionsService->getById($id);
    $permission->setName($name);
    $permission->setGuardName($guard_name);

    $this->permissionsService->update($permission);
    $_SESSION['notifications'] = [
      'message' => 'Updated Permission successfully',
      'alert-type' => 'success'
    ];

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
  }

  public function deletePermission($id)
  {
    $this->permissionsService->delete($id);

    $_SESSION['notifications'] = [
      'message' => 'Deleted Permission successfully',
      'alert-type' => 'success'
    ];

    header("Location: /all/permission");
    exit;
  }

  public function allRoles()
  {
    $admin = $this->getInfoHeader();
    $roles = $this->rolesService->getAll();

    require ABSPATH . 'resources/admin/auth/allRoles.php';
  }

  public function addRole()
  {
    $admin = $this->getInfoHeader();

    require ABSPATH . 'resources/admin/auth/addRole.php';
  }

  public function storeRole()
  {
    $name = $_POST['name'] ?? '';

    $params = [
      'name' => $name,
      'permissions' => []
    ];
    $this->rolesService->save($params);

    $_SESSION['notification'] = [
      'message' => 'Added Roles successfully',
      'alert-type' => 'success'
    ];

    header("Location: /all/roles");
    exit;
  }

  public function editRole($id)
  {
    $admin = $this->getInfoHeader();
    $role = $this->rolesService->getById($id);

    require ABSPATH . 'resources/admin/auth/editRole.php';
  }

  public function updateRole()
  {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $role = $this->rolesService->getById($id);
    $role->setName($name);
    $this->rolesService->update($role);

    $_SESSION['notification'] = [
      'message' => 'Updated Roles successfully',
      'alert-type' => 'success'
    ];

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
  }

  public function deleteRole($id)
  {
    $this->rolesService->delete($id);

    $_SESSION['notification'] = [
      'message' => 'Deleted Roles successfully',
      'alert-type' => 'success'
    ];

    header("Location: /all/roles");
    exit;
  }

  public function addRolesPermission()
  {
    $admin = $this->getInfoHeader();
    $roles = $this->rolesService->getAll();
    $permissions = $this->permissionsService->getAll();
    $permissions_groups = $this->permissionsService->getPermissionGroups();

    $permissions_groups_byName = [];
    foreach ($permissions_groups as $group) {
      $guard_name = $group['guard_name'];
      $permissions = $this->permissionsService->getPermissionByGroupName($guard_name);
      $permissions_groups_byName[$guard_name] = $permissions;
    }

    require ABSPATH . 'resources/admin/auth/addRolesPermission.php';
  }

  public function rolePermissionStore()
  {
    $data = array();
    $permissions = $_POST['permission'] ?? [];
    foreach ($permissions as $key => $permission) {
      $data['role_id'] = $_POST['role_id'];
      $data['permission_id'][] = $permission;
    }

    $role = $this->rolesService->getById($_POST['role_id']);
    $role->setPermissions($permissions);
    $this->rolesService->updatePermission($role);
    if ($role === null) {
      $_SESSION['notification'] = [
        'message' => "Role not found.",
        'alert-type' => 'error',
      ];
      header("Location: /all/roles");
      exit;
    }
    $role->setPermissions($permission);
    $this->rolesService->update($role);
    $this->roleHasPermissionsService->save($data);

    $_SESSION['notification'] = [
      'message' => "Role Permission Added successfully",
      'alert-type' => 'success',
    ];
    header("Location: /all/roles/permission");
    exit;
  }

  public function allRolesPermission()
  {
    $admin = $this->getInfoHeader();
    $roles = $this->rolesService->getAll();
    foreach ($roles as $role) {
      $permissions = $this->roleHasPermissionsService->getPermissionsByRoleId($role->getId());
      $role->setPermissions($permissions);
    }

    require ABSPATH . 'resources/admin/auth/allRolesPermission.php';
  }

  public function adminEditRoles($id)
  {
    $admin = $this->getInfoHeader();
    $role = $this->rolesService->getById($id);
    $permissionsAll = $this->permissionsService->getAll();
    $permissions_groups = $this->permissionsService->getPermissionGroups();

    $rolePermissions = $this->roleHasPermissionsService->getPermissionsByRoleId($id);
    $role->setPermissions($rolePermissions);

    $permissions_groups_byName = [];
    foreach ($permissions_groups as $group) {
      $guard_name = $group['guard_name'];
      $permissions = $this->permissionsService->getPermissionByGroupName($guard_name);
      $permissions_groups_byName[$guard_name] = $permissions;
    }

    $checkRoleHasPermission = $this->roleHasPermissions($role, $rolePermissions);

    require ABSPATH . 'resources/admin/auth/editRolesPermission.php';
  }

  public static function roleHasPermissions($role, $permissions)
  {
    $hasPermission = true;
    foreach ($permissions as $permission) {
      if (!$role->hasPermissionTo($permission['name'])) {
        $hasPermission = false;
      }
    }
    return $hasPermission;
  }

  private function syncPermissions($roleId, $newPermissions)
  {
    $currentPermissions = $this->roleHasPermissionsService->getPermissionsByRoleId($roleId);

    $currentPermissions = array_map(function ($permission) {
      return $permission['id'];
    }, $currentPermissions);

    $permissionsToAdd = array_diff($newPermissions, $currentPermissions);

    $permissionsToRemove = array_diff($currentPermissions, $newPermissions);

    if (!empty($permissionsToAdd)) {
      $this->roleHasPermissionsService->save([
        'role_id' => $roleId,
        'permission_id' => $permissionsToAdd,
      ]);
    }

    if (!empty($permissionsToRemove)) {
      $this->roleHasPermissionsService->removePermissions($roleId, $permissionsToRemove);
    }
  }

  public function adminUpdateRoles($id)
  {
    $role = $this->rolesService->getById($id);
    $permissions = $_POST['permission'] ?? [];

    if (!empty($permissions)) {
      $this->syncPermissions($role->getId(), $permissions);
    }

    $_SESSION['notification'] = [
      'message' => "Role Permissions Updated successfully",
      'alert-type' => 'success',
    ];

    header("Location: /admin/edit/roles/$id");
    exit;
  }

  public function adminDeleteRoles($id)
  {
    $role = $this->rolesService->getById($id);
    if (!is_null($role)) {
      $this->roleHasPermissionsService->deleteRolePermissions($id);
    }

    $_SESSION['notification'] = [
      'message' => "Deleted Role Permissions successfully",
      'alert-type' => 'success',
    ];

    header("Location: /all/roles/permission");
    exit;
  }
}
