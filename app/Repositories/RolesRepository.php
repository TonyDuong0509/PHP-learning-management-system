<?php

namespace App\Repositories;

use App\Models\Roles;
use App\Repositories\Interfaces\RolesRepositoryInterface;

class RolesRepository implements RolesRepositoryInterface
{
  public function fetchAll($condition = null)
  {
    global $conn;

    $roles = array();
    $sql = "SELECT * FROM roles";
    if ($condition) {
      $sql .= " WHERE $condition";
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $role = new Roles($row['id'], $row['name'], $row['permissions']);
        $roles[] = $role;
      }
    }
    return $roles;
  }

  public function save($params)
  {
    global $conn;

    $name = $params['name'] ?? '';
    $permissions = $params['permissions'] ?? '';

    $sql = "INSERT INTO roles (name, role_id)
            VALUES ('$name', '$permissions')";
    if ($conn->query($sql) === true) {
      $last_id = $conn->insert_id;
      return $last_id;
    }
    echo "Error: " . $sql . PHP_EOL;
    return false;
  }

  public function update($role)
  {
    global $conn;

    $id = $role->getId();
    $name = $role->getName();

    $sql = "UPDATE roles
            SET name = '$name'
            WHERE id = '$id'";
    if ($conn->query($sql) === true) {
      return true;
    }
    echo "Error: " . $sql . PHP_EOL;
    return false;
  }

  public function updatePermission($role)
  {
    global $conn;

    $id = $role->getId();
    $permissions = $role->getPermissions();
    $sql = "UPDATE roles
            SET permissions = '$permissions'
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

    $sql = "DELETE FROM roles
            WHERE id = '$id'";
    if ($conn->query($sql) === true) {
      return true;
    }
    echo "Error: " . $sql . PHP_EOL;
    return false;
  }

  public function getById($id)
  {
    $condition = "id = '$id'";
    $roles = $this->fetchAll($condition);
    $role = current($roles);
    return $role;
  }
}
