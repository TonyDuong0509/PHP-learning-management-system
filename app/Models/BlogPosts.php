<?php

namespace App\Models;

use App\Repositories\BlogCategoriesRepository;

class BlogPosts
{
    protected $id;
    protected $blogcategory_id;
    protected $post_title;
    protected $post_slug;
    protected $post_image;
    protected $description;
    protected $post_tags;
    protected $created_at;

    public function __construct($id, $blogcategory_id, $post_title, $post_slug, $post_image, $description, $post_tags, $created_at)
    {
        $this->id = $id;
        $this->blogcategory_id = $blogcategory_id;
        $this->post_title = $post_title;
        $this->post_slug = $post_slug;
        $this->post_image = $post_image;
        $this->description = $description;
        $this->post_tags = $post_tags;
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
     * Get the value of blogcategory_id
     */
    public function getBlogcategoryId()
    {
        return $this->blogcategory_id;
    }

    /**
     * Set the value of blogcategory_id
     */
    public function setBlogcategoryId($blogcategory_id): self
    {
        $this->blogcategory_id = $blogcategory_id;

        return $this;
    }

    /**
     * Get the value of post_title
     */
    public function getPostTitle()
    {
        return $this->post_title;
    }

    /**
     * Set the value of post_title
     */
    public function setPostTitle($post_title): self
    {
        $this->post_title = $post_title;

        return $this;
    }

    /**
     * Get the value of post_slug
     */
    public function getPostSlug()
    {
        return $this->post_slug;
    }

    /**
     * Set the value of post_slug
     */
    public function setPostSlug($post_slug): self
    {
        $this->post_slug = $post_slug;

        return $this;
    }

    /**
     * Get the value of post_image
     */
    public function getPostImage()
    {
        return $this->post_image;
    }

    /**
     * Set the value of post_image
     */
    public function setPostImage($post_image): self
    {
        $this->post_image = $post_image;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of post_tags
     */
    public function getPostTags()
    {
        return $this->post_tags;
    }

    /**
     * Set the value of post_tags
     */
    public function setPostTags($post_tags): self
    {
        $this->post_tags = $post_tags;

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

    public function getBlogCategory()
    {
        $blogCategoryRepository = new BlogCategoriesRepository();
        $blogCategory = $blogCategoryRepository->getById($this->blogcategory_id);
        return $blogCategory;
    }
}
