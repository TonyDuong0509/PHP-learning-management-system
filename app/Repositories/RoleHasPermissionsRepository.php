<?php

namespace App\Repositories;

use App\Models\RoleHasPermissions;
use App\Repositories\Interfaces\RoleHasPermissionsRepositoryInterface;

class RoleHasPermissionsRepository implements RoleHasPermissionsRepositoryInterface
{
  public function save($params)
  {
    global $conn;
    $role_id = $params['role_id'];
    $permission_ids = $params['permission_id'];

    $sql = "INSERT INTO role_has_permissions (role_id, permission_id) VALUES ";

    $values = [];
    foreach ($permission_ids as $permission_id) {
      $values[] = "('$role_id', '$permission_id')";
    }

    $sql .= implode(", ", $values);

    if ($conn->query($sql) === true) {
      return true;
    } else {
      echo "Error: " . $sql . PHP_EOL . $conn->error;
      return false;
    }
  }

  public function fetchAll($condition = null)
  {
    global $conn;

    $roles = array();
    $sql = "SELECT * FROM role_has_permissions";
    if ($condition) {
      $sql .= " WHERE $condition";
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $roleHasPermission = new RoleHasPermissions($row['role_id'], $row['permission_id']);
        $roles[] = $roleHasPermission;
      }
    }
    return $roles;
  }

  public function getPermissionsByRoleId($role_id)
  {
    global $conn;
    $permissions = array();
    $sql = "SELECT p.* FROM permissions p 
            INNER JOIN role_has_permissions rp ON p.id = rp.permission_id 
            WHERE rp.role_id = '$role_id'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $permissions[] = $row;
      }
    }
    return $permissions;
  }

  public function removePermissions($roleId, $permissionsToRemove)
  {
    global $conn;

    $sql = "DELETE FROM role_has_permissions 
            WHERE role_id = '$roleId' 
            AND permission_id IN (" . implode(',', array_map('intval', $permissionsToRemove)) . ")";

    if ($conn->query($sql) === true) {
      return true;
    }
    echo "Error: " . $sql . PHP_EOL . $conn->error;
    return false;
  }

  public function deleteRolePermissions($role_id)
  {
    global $conn;

    $sql = "DELETE FROM role_has_permissions
            WHERE role_id = '$role_id'";

    if ($conn->query($sql) === true) {
      return true;
    }
    echo "Error: " . $sql . PHP_EOL . $conn->error;
    return false;
  }
}
