<?php

namespace App\Models;

class Roles
{
  protected $id;
  protected $name;
  protected $permissions = [];

  public function __construct($id, $name, $permissions = [])
  {
    $this->id = $id;
    $this->name = $name;
    $this->permissions = $permissions;
  }

  /**
   * Get the value of id
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   */
  public function setId($id): self
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of name
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   */
  public function setName($name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getPermissions()
  {
    return $this->permissions;
  }

  public function setPermissions($permissions): self
  {
    $this->permissions = $permissions;

    return $this;
  }

  public function hasPermissionTo($permissionName)
  {
    if (empty($this->permissions)) {
      echo "Permissions array is empty or not initialized.";
      return false;
    }

    foreach ($this->permissions as $permission) {
      if (isset($permission['name']) && $permission['name'] === $permissionName) {
        return true;
      }
    }
    return false;
  }
}
