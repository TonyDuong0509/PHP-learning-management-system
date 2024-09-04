<?php

namespace App\Repositories;

use App\Models\Notifications;
use App\Repositories\Interfaces\NotificationsRepositoryInterface;

class NotificationsRepository implements NotificationsRepositoryInterface
{
  public function save($params)
  {
    global $conn;

    $type = $conn->real_escape_string($params['type']);
    $notifiable = $params['notifiable'];
    $data = $params['data'];
    $read_at = $params['read_at'];
    $created_at = $params['created_at'];

    $sql = "INSERT INTO notifications (type, notifiable, data, read_at, created_at)
            VALUES ('$type', '$notifiable', '$data', '$read_at', '$created_at')";
    if ($conn->query($sql) === true) {
      $last_id = $conn->insert_id;
      return $last_id;
    }
    echo "Error: " . $sql . PHP_EOL;
    return false;
  }

  public function fetchAll($condition = null)
  {
    global $conn;

    $notifications = array();
    $sql = "SELECT * FROM notifications";
    if ($condition) {
      $sql .= " WHERE $condition";
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $notification = new Notifications($row['id'], $row['type'], $row['notifiable'], $row['data'], $row['read_at'], $row['created_at']);
        $notifications[] = $notification;
      }
    }
    return $notifications;
  }

  public function getNotificationsForInstructor($instructor_id)
  {
    $condition = "notifiable = '$instructor_id' ORDER BY created_at DESC";
    return $this->fetchAll($condition);
  }
  public function getTotalNotificationsForInstructor($instructor_id)
  {
    global $conn;

    $sql = "SELECT COUNT(*) as total
            FROM notifications
            WHERE notifiable = '$instructor_id'
            AND read_at = 0";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();

      return (int) $row['total'];
    }
    return 0;
  }

  public function updateStatusNotification()
  {
    global $conn;

    $sql = "UPDATE notifications
            SET read_at = 1";
    if ($conn->query($sql) === true) {
      return true;
    }
    echo "Error: " . $sql . PHP_EOL;
    return false;
  }
}
