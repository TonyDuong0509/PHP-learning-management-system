<?php

namespace App\Models;

class Notifications
{
  protected $id;
  protected $type;
  protected $notifiable;
  protected $data;
  protected $read_at;
  protected $created_at;

  public function __construct($id, $type, $notifiable, $data, $read_at, $created_at)
  {
    $this->id = $id;
    $this->type = $type;
    $this->notifiable = $notifiable;
    $this->data = $data;
    $this->read_at = $read_at;
    $this->created_at = $created_at;
  }

  /**
   * Get the value of id
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   */
  public function setId($id): self
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of type
   */
  public function getType()
  {
    return $this->type;
  }

  /**
   * Set the value of type
   */
  public function setType($type): self
  {
    $this->type = $type;

    return $this;
  }

  /**
   * Get the value of notifiable
   */
  public function getNotifiable()
  {
    return $this->notifiable;
  }

  /**
   * Set the value of notifiable
   */
  public function setNotifiable($notifiable): self
  {
    $this->notifiable = $notifiable;

    return $this;
  }

  /**
   * Get the value of data
   */
  public function getData()
  {
    return $this->data;
  }

  /**
   * Set the value of data
   */
  public function setData($data): self
  {
    $this->data = $data;

    return $this;
  }

  /**
   * Get the value of read_at
   */
  public function getReadAt()
  {
    return $this->read_at;
  }

  /**
   * Set the value of read_at
   */
  public function setReadAt($read_at): self
  {
    $this->read_at = $read_at;

    return $this;
  }

  /**
   * Get the value of created_at
   */
  public function getCreatedAt()
  {
    return $this->created_at;
  }

  /**
   * Set the value of created_at
   */
  public function setCreatedAt($created_at): self
  {
    $this->created_at = $created_at;

    return $this;
  }
}
