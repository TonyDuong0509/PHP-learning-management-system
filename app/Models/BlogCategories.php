<?php

namespace App\Models;

class BlogCategories
{
    protected $id;
    protected $category_name;
    protected $category_slug;
    protected $created_at;

    public function __construct($id, $category_name, $category_slug, $created_at)
    {
        $this->id = $id;
        $this->category_name = $category_name;
        $this->category_slug = $category_slug;
        $this->created_at = $created_at;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'category_name' => $this->category_name,
            'category_slug' => $this->category_slug,
            'created_at' => $this->created_at,
        ];
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
     * Get the value of category_name
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * Set the value of category_name
     */
    public function setCategoryName($category_name): self
    {
        $this->category_name = $category_name;

        return $this;
    }

    /**
     * Get the value of category_slug
     */
    public function getCategorySlug()
    {
        return $this->category_slug;
    }

    /**
     * Set the value of category_slug
     */
    public function setCategorySlug($category_slug): self
    {
        $this->category_slug = $category_slug;

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
