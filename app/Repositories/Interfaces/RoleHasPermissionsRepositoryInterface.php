<?php

namespace App\Repositories\Interfaces;

interface RoleHasPermissionsRepositoryInterface
{
  public function save($params);
  public function fetchAll($condition = null);
  public function getPermissionsByRoleId($role_id);
  public function removePermissions($roleId, $permissionsToRemove);
  public function deleteRolePermissions($role_id);
}
