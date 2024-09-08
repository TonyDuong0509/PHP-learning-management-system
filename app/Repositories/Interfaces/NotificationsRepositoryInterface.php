<?php

namespace App\Repositories\Interfaces;

interface NotificationsRepositoryInterface
{
  public function save($params);
  public function fetchAll($condition = null);
  public function getNotificationsForInstructor($instructor_id);
  public function updateStatusNotification();
  public function getTotalNotificationsForInstructor($instructor_id);
}
