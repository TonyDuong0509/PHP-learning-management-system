<?php

namespace App\Services;

use App\Repositories\NotificationsRepository;

class NotificationsService
{
  private $notificationsRepository;

  public function __construct(NotificationsRepository $notificationsRepository)
  {
    $this->notificationsRepository = $notificationsRepository;
  }

  public function getAll()
  {
    return $this->notificationsRepository->fetchAll();
  }

  public function saveNotify($params)
  {
    return $this->notificationsRepository->save($params);
  }

  public function getNotificationsForInstructor($instructor_id)
  {
    return $this->notificationsRepository->getNotificationsForInstructor($instructor_id);
  }

  public function updateStatusNotifications()
  {
    return $this->notificationsRepository->updateStatusNotification();
  }

  public function getTotalNotificationsForInstructor($instructor_id)
  {
    return $this->notificationsRepository->getTotalNotificationsForInstructor($instructor_id);
  }
}
