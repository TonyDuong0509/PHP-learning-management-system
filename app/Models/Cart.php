<?php

namespace App\Models;

class Cart
{
    protected $id;
    protected $course_id;
    protected $name;
    protected $qty;
    protected $price;
    protected $weight;
    protected $options;

    public function __construct($id, $course_id, $name, $qty, $price, $weight, $options)
    {
        $this->id = $id;
        $this->course_id = $course_id;
        $this->name = $name;
        $this->qty = $qty;
        $this->price = $price;
        $this->weight = $weight;
        $this->options = $options;
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
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of qty
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Set the value of qty
     */
    public function setQty($qty): self
    {
        $this->qty = $qty;

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
     * Get the value of weight
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set the value of weight
     */
    public function setWeight($weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get the value of options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the value of options
     */
    public function setOptions($options): self
    {
        $this->options = $options;

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
}
