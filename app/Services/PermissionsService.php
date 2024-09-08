<?php

namespace App\Services;

use App\Repositories\PermissionsRepository;

class PermissionsService
{
  private $permissionsRepository;

  public function __construct(PermissionsRepository $permissionsRepository)
  {
    $this->permissionsRepository = $permissionsRepository;
  }

  public function getAll()
  {
    return $this->permissionsRepository->fetchAll();
  }

  public function save($params)
  {
    return $this->permissionsRepository->save($params);
  }

  public function getById($id)
  {
    return $this->permissionsRepository->getById($id);
  }

  public function update($permission)
  {
    return $this->permissionsRepository->update($permission);
  }

  public function delete($id)
  {
    return $this->permissionsRepository->delete($id);
  }

  public function getPermissionGroups()
  {
    return $this->permissionsRepository->getPermissionGroups();
  }

  public function getPermissionByGroupName($guard_name)
  {
    return $this->permissionsRepository->getPermissionByGroupName($guard_name);
  }
}
