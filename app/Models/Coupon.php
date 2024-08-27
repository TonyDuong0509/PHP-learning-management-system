<?php

namespace App\Models;

use App\Repositories\CourseRepository;
use App\Repositories\UserRepository;

class Coupon
{
    protected $id;
    protected $coupon_name;
    protected $coupon_discount;
    protected $coupon_validity;
    protected $instructor_id;
    protected $course_id;
    protected $status;
    protected $created_at;

    public function __construct($id, $coupon_name, $coupon_discount, $coupon_validity, $instructor_id, $course_id, $status, $created_at)
    {
        $this->id = $id;
        $this->coupon_name = $coupon_name;
        $this->coupon_discount = $coupon_discount;
        $this->coupon_validity = $coupon_validity;
        $this->instructor_id = $instructor_id;
        $this->course_id = $course_id;
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
     * Get the value of coupon_name
     */
    public function getCouponName()
    {
        return $this->coupon_name;
    }

    /**
     * Set the value of coupon_name
     */
    public function setCouponName($coupon_name): self
    {
        $this->coupon_name = $coupon_name;

        return $this;
    }

    /**
     * Get the value of coupon_discount
     */
    public function getCouponDiscount()
    {
        return $this->coupon_discount;
    }

    /**
     * Set the value of coupon_discount
     */
    public function setCouponDiscount($coupon_discount): self
    {
        $this->coupon_discount = $coupon_discount;

        return $this;
    }

    /**
     * Get the value of coupon_validity
     */
    public function getCouponValidity()
    {
        return $this->coupon_validity;
    }

    /**
     * Set the value of coupon_validity
     */
    public function setCouponValidity($coupon_validity): self
    {
        $this->coupon_validity = $coupon_validity;

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

    public function getCourseName()
    {
        $courseRepository = new CourseRepository();
        $course = $courseRepository->getById($this->course_id);
        return $course->getName();
    }

    public function getInstructorEmail()
    {
        $userRepository = new UserRepository();
        $user = $userRepository->getById($this->instructor_id);
        return $user->getEmail();
    }
}
