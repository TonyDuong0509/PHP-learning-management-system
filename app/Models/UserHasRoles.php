<?php

namespace App\Models;

class UserHasRoles
{
  protected $user_id;
  protected $role_id;

  public function __construct($user_id, $role_id)
  {
    $this->user_id = $user_id;
    $this->role_id = $role_id;
  }

  /**
   * Get the value of user_id
   */
  public function getUserId()
  {
    return $this->user_id;
  }

  /**
   * Set the value of user_id
   */
  public function setUserId($user_id): self
  {
    $this->user_id = $user_id;

    return $this;
  }

  /**
   * Get the value of role_id
   */
  public function getRoleId()
  {
    return $this->role_id;
  }

  /**
   * Set the value of role_id
   */
  public function setRoleId($role_id): self
  {
    $this->role_id = $role_id;

    return $this;
  }
}
