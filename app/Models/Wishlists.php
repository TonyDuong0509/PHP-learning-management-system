<?php

namespace App\Models;

use App\Repositories\CourseRepository;

class Wishlists
{
    protected $id;
    protected $user_id;
    protected $course_id;
    protected $created_at;

    public function __construct($id, $user_id, $course_id, $created_at)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->course_id = $course_id;
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
     * Get the value of user_id
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId($user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of course_id
     */
    public function getCourseId()
    {
        return $this->course_id;
    }

    /**
     * Set the value of course_id
     */
    public function setCourseId($course_id): self
    {
        $this->course_id = $course_id;

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
