<?php

namespace App\Services;

use App\Repositories\RolesRepository;

class RolesService
{
  private $rolesRepository;

  public function __construct(RolesRepository $rolesRepository)
  {
    $this->rolesRepository = $rolesRepository;
  }

  public function getAll()
  {
    return $this->rolesRepository->fetchAll();
  }

  public function save($params)
  {
    return $this->rolesRepository->save($params);
  }

  public function update($role)
  {
    return $this->rolesRepository->update($role);
  }

  public function updatePermission($role)
  {
    return $this->rolesRepository->updatePermission($role);
  }

  public function delete($id)
  {
    return $this->rolesRepository->delete($id);
  }

  public function getById($id)
  {
    return $this->rolesRepository->getById($id);
  }
}
