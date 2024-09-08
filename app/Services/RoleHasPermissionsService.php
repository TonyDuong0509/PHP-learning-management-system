<?php

namespace App\Services;

use App\Repositories\RoleHasPermissionsRepository;

class RoleHasPermissionsService
{
  private $roleHasPermissionsRepository;

  public function __construct(RoleHasPermissionsRepository $roleHasPermissionsRepository)
  {
    $this->roleHasPermissionsRepository = $roleHasPermissionsRepository;
  }

  public function save($params)
  {
    return $this->roleHasPermissionsRepository->save($params);
  }

  public function getAll()
  {
    return $this->roleHasPermissionsRepository->fetchAll();
  }

  public function getPermissionsByRoleId($role_id)
  {
    return $this->roleHasPermissionsRepository->getPermissionsByRoleId($role_id);
  }

  public function removePermissions($roleId, $permissionsToRemove)
  {
    return $this->roleHasPermissionsRepository->removePermissions($roleId, $permissionsToRemove);
  }

  public function deleteRolePermissions($role_id)
  {
    return $this->roleHasPermissionsRepository->deleteRolePermissions($role_id);
  }
}
