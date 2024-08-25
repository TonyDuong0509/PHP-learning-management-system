<?php

namespace App\Models;

use App\Repositories\CourseRepository;
use App\Repositories\UserRepository;

class Questions
{
    protected $id;
    protected $course_id;
    protected $user_id;
    protected $instructor_id;
    protected $parent_id;
    protected $subject;
    protected $question;
    protected $created_at;

    public function __construct($id, $course_id, $user_id, $instructor_id, $parent_id, $subject, $question, $created_at)
    {
        $this->id = $id;
        $this->course_id = $course_id;
        $this->user_id = $user_id;
        $this->instructor_id = $instructor_id;
        $this->parent_id = $parent_id;
        $this->subject = $subject;
        $this->question = $question;
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
     * Get the value of instructor_id
     */
    public function getInstructorId()
    {
        return $this->instructor_id;
    }

    /**
     * Set the value of instructor_id
     */
    public function setInstructorId($instructor_id): self
    {
        $this->instructor_id = $instructor_id;

        return $this;
    }

    /**
     * Get the value of parent_id
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Set the value of parent_id
     */
    public function setParentId($parent_id): self
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    /**
     * Get the value of subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the value of subject
     */
    public function setSubject($subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get the value of question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set the value of question
     */
    public function setQuestion($question): self
    {
        $this->question = $question;

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

    public function getCourse()
    {
        $courseRepository = new CourseRepository();
        $course = $courseRepository->getById($this->course_id);
        return $course;
    }

    public function getUser()
    {
        $userRepository = new UserRepository();
        $user = $userRepository->getById($this->user_id);
        return $user;
    }

    public function getInstructor()
    {
        $userRepository = new UserRepository();
        $user = $userRepository->getById($this->instructor_id);
        return $user;
    }
}
