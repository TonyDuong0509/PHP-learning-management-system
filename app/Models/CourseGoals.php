<?php

namespace App\Models;

class CourseGoals
{
    protected $id;
    protected $course_id;
    protected $goal_name;
    protected $created_at;

    public function __construct($id, $course_id, $goal_name, $created_at)
    {
        $this->id = $id;
        $this->course_id = $course_id;
        $this->goal_name = $goal_name;
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
     * Get the value of goal_name
     */
    public function getGoalName()
    {
        return $this->goal_name;
    }

    /**
     * Set the value of goal_name
     */
    public function setGoalName($goal_name): self
    {
        $this->goal_name = $goal_name;

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
