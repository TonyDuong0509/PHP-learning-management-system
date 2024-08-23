<?php

namespace App\Models;

use App\Repositories\CourseRepository;
use App\Repositories\PaymentsRepository;
use App\Repositories\UserRepository;

class Orders
{
    protected $id;
    protected $payment_id;
    protected $user_id;
    protected $instructor_id;
    protected $course_id;
    protected $course_title;
    protected $price;
    protected $created_at;

    public function __construct($id, $payment_id, $user_id, $instructor_id, $course_id, $course_title, $price, $created_at)
    {
        $this->id = $id;
        $this->payment_id = $payment_id;
        $this->user_id = $user_id;
        $this->instructor_id = $instructor_id;
        $this->course_id = $course_id;
        $this->course_title = $course_title;
        $this->price = $price;
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
     * Get the value of payment_id
     */
    public function getPaymentId()
    {
        return $this->payment_id;
    }

    /**
     * Set the value of payment_id
     */
    public function setPaymentId($payment_id): self
    {
        $this->payment_id = $payment_id;

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
     * Get the value of course_title
     */
    public function getCourseTitle()
    {
        return $this->course_title;
    }

    /**
     * Set the value of course_title
     */
    public function setCourseTitle($course_title): self
    {
        $this->course_title = $course_title;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice($price): self
    {
        $this->price = $price;

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

    public function getInstructor()
    {
        $userRepository = new UserRepository();
        $instructor = $userRepository->getById($this->instructor_id);
        return $instructor;
    }

    public function getCourse()
    {
        $courseRepository = new CourseRepository();
        $course = $courseRepository->getById($this->course_id);
        return $course;
    }

    public function getPayment()
    {
        $paymentRepository = new PaymentsRepository();
        $payment = $paymentRepository->getById($this->payment_id);
        return $payment;
    }
}
