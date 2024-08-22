<?php

namespace App\Models;

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
        $this->$user_id = $$user_id;
        $this->$instructor_id = $$instructor_id;
        $this->$course_id = $$course_id;
        $this->$course_title = $$course_title;
        $this->$price = $$price;
        $this->$created_at = $$created_at;
    }
}
