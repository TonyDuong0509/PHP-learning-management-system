<?php

namespace App\Repositories;

use App\Models\Permissions;
use App\Repositories\Interfaces\PermissionsRepositoryInterface;

class PermissionsRepository implements PermissionsRepositoryInterface
{
  public function fetchAll($condition = null)
  {
    global $conn;

    $permissions = array();
    $sql = "SELECT * FROM permissions";
    if ($condition) {
      $sql .= " WHERE $condition";
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $permission = new Permissions($row['id'], $row['name'], $row['guard_name']);
        $permissions[] = $permission;
      }
    }

    return $permissions;
  }

  public function save($params)
  {
    global $conn;

    $name = $params['name'];
    $guard_name = $params['guard_name'];

    $sql = "INSERT INTO permissions (name, guard_name)
            VALUES ('$name', '$guard_name')";

    if ($conn->query($sql) === true) {
      $last_id = $conn->insert_id;
      return $last_id;
    }
    echo "Error: " . $sql . PHP_EOL;
    return false;
  }

  public function getById($id)
  {
    $condition = "id = '$id'";
    $permissions = $this->fetchAll($condition);
    $permission = current($permissions);
    return $permission;
  }

  public function update($permission)
  {
    global $conn;

    $id = $permission->getId();
    $name = $permission->getName();
    $guard_name = $permission->getGuardName();

    $sql = "UPDATE permissions
            SET name = '$name', guard_name = '$guard_name'
            WHERE id = '$id'";
    if ($conn->query($sql) === true) {
      return true;
    }
    echo "Error: " . $sql . PHP_EOL;
    return false;
  }

  public function delete($id)
  {
    global $conn;

    $sql = "DELETE FROM permissions
            WHERE id = '$id'";

    if ($conn->query($sql) === true) {
      return true;
    }
    echo "Error: " . $sql . PHP_EOL;
    return false;
  }

  public function getPermissionGroups()
  {
    global $conn;

    $permissionsGroup = array();
    $sql = "SELECT DISTINCT guard_name FROM permissions";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $permissionsGroup[] = $row;
      }
    }
    return $permissionsGroup;
  }

  public function getPermissionByGroupName($guard_name)
  {
    $condition = "guard_name = '$guard_name'";
    return $this->fetchAll($condition);
  }
}
