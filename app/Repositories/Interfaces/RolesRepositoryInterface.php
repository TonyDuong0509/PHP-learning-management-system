<?php

namespace App\Repositories\Interfaces;

interface RolesRepositoryInterface
{
  public function fetchAll($condition = null);
  public function save($params);
  public function update($role);
  public function delete($id);
  public function getById($id);
}
