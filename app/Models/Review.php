<?php

namespace App\Models;

use App\Repositories\UserRepository;

class Review
{
    protected $id;
    protected $course_id;
    protected $user_id;
    protected $instructor_id;
    protected $comment;
    protected $rating;
    protected $status;
    protected $created_at;

    public function __construct(
        $id,
        $course_id,
        $user_id,
        $instructor_id,
        $comment,
        $rating,
        $status,
        $created_at
    ) {
        $this->id = $id;
        $this->course_id = $course_id;
        $this->user_id = $user_id;
        $this->instructor_id = $instructor_id;
        $this->comment = $comment;
        $this->rating = $rating;
        $this->status = $status;
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
     * Get the value of comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     */
    public function setComment($comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of rating
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     */
    public function setRating($rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus($status): self
    {
        $this->status = $status;

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

    public function getUser()
    {
        $userRepository = new UserRepository();
        $user = $userRepository->getById($this->user_id);
        return $user;
    }
}
