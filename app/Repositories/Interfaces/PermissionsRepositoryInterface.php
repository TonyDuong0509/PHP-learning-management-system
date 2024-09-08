<?php

namespace App\Repositories\Interfaces;

interface PermissionsRepositoryInterface
{
  public function fetchAll($condition = null);
  public function save($params);
  public function getById($id);
  public function update($permission);
  public function delete($id);
  public function getPermissionGroups();
  public function getPermissionByGroupName($guard_name);
}
