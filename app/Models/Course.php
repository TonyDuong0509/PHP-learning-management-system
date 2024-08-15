<?php

namespace App\Models;

use App\Repositories\CategoryRepository;
use App\Repositories\CourseRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\UserRepository;

class Course
{
    protected $id;
    protected $category_id;
    protected $subcategory_id;
    protected $instructor_id;
    protected $image;
    protected $title;
    protected $name;
    protected $slug;
    protected $description;
    protected $video;
    protected $duration;
    protected $selling_price;
    protected $discount_price;
    protected $prerequisuites;
    protected $bestseller;
    protected $featured;
    protected $highestrated;
    protected $status;
    protected $created_at;
    protected $certificate;
    protected $resources;
    protected $label;
    protected $type_id;

    public function __construct(
        $id,
        $category_id,
        $subcategory_id,
        $instructor_id,
        $image,
        $title,
        $name,
        $slug,
        $description,
        $video,
        $duration,
        $selling_price,
        $discount_price,
        $prerequisuites,
        $bestseller,
        $featured,
        $highestrated,
        $status,
        $created_at,
        $certificate,
        $resources,
        $label,
        $type_id
    ) {
        $this->id = $id;
        $this->category_id = $category_id;
        $this->subcategory_id = $subcategory_id;
        $this->instructor_id = $instructor_id;
        $this->image = $image;
        $this->title = $title;
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->video = $video;
        $this->duration = $duration;
        $this->selling_price = $selling_price;
        $this->discount_price = $discount_price;
        $this->prerequisuites = $prerequisuites;
        $this->bestseller = $bestseller;
        $this->featured = $featured;
        $this->highestrated = $highestrated;
        $this->status = $status;
        $this->created_at = $created_at;
        $this->certificate = $certificate;
        $this->resources = $resources;
        $this->label = $label;
        $this->type_id = $type_id;
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
     * Get the value of category_id
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     */
    public function setCategoryId($category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of subcategory_id
     */
    public function getSubcategoryId()
    {
        return $this->subcategory_id;
    }

    /**
     * Set the value of subcategory_id
     */
    public function setSubcategoryId($subcategory_id): self
    {
        $this->subcategory_id = $subcategory_id;

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
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle($title): self
    {
        $this->title = $title;

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
     * Get the value of slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     */
    public function setSlug($slug): self
    {
        $this->slug = $slug;

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
     * Get the value of video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set the value of video
     */
    public function setVideo($video): self
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get the value of duration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     */
    public function setDuration($duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get the value of selling_price
     */
    public function getSellingPrice()
    {
        return $this->selling_price;
    }

    /**
     * Set the value of selling_price
     */
    public function setSellingPrice($selling_price): self
    {
        $this->selling_price = $selling_price;

        return $this;
    }

    /**
     * Get the value of discount_price
     */
    public function getDiscountPrice()
    {
        return $this->discount_price;
    }

    /**
     * Set the value of discount_price
     */
    public function setDiscountPrice($discount_price): self
    {
        $this->discount_price = $discount_price;

        return $this;
    }

    /**
     * Get the value of prerequisuites
     */
    public function getPrerequisuites()
    {
        return $this->prerequisuites;
    }

    /**
     * Set the value of prerequisuites
     */
    public function setPrerequisuites($prerequisuites): self
    {
        $this->prerequisuites = $prerequisuites;

        return $this;
    }

    /**
     * Get the value of bestseller
     */
    public function getBestseller()
    {
        return $this->bestseller;
    }

    /**
     * Set the value of bestseller
     */
    public function setBestseller($bestseller): self
    {
        $this->bestseller = $bestseller;

        return $this;
    }

    /**
     * Get the value of featured
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Set the value of featured
     */
    public function setFeatured($featured): self
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get the value of highestrated
     */
    public function getHighestrated()
    {
        return $this->highestrated;
    }

    /**
     * Set the value of highestrated
     */
    public function setHighestrated($highestrated): self
    {
        $this->highestrated = $highestrated;

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
     * Get the value of certificate
     */
    public function getCertificate()
    {
        return $this->certificate;
    }

    /**
     * Set the value of certificate
     */
    public function setCertificate($certificate): self
    {
        $this->certificate = $certificate;

        return $this;
    }

    /**
     * Get the value of resources
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * Set the value of resources
     */
    public function setResources($resources): self
    {
        $this->resources = $resources;

        return $this;
    }

    /**
     * Get the value of label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set the value of label
     */
    public function setLabel($label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getCategoryName()
    {
        $categoryRepository = new CategoryRepository();
        $category = $categoryRepository->getById($this->category_id);

        return $category->getName();
    }

    public function getSubCategoryName()
    {
        $subCategoryRepository = new SubCategoryRepository();
        $subCategory = $subCategoryRepository->getById($this->subcategory_id);

        return $subCategory->getName();
    }

    public function getInstructorName()
    {
        $userRepository = new UserRepository();
        $instructor = $userRepository->getById($this->instructor_id);

        return $instructor->getName();
    }

    public function getInstructorEmail()
    {
        $userRepository = new UserRepository();
        $instructor = $userRepository->getById($this->instructor_id);

        return $instructor->getEmail();
    }

    public function getCoursesOfInstructor()
    {
        $courseRepository = new CourseRepository();
        $condition = "instructor_id = '$this->instructor_id'";

        return $courseRepository->fetchAll($condition);
    }

    /**
     * Get the value of type_id
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set the value of type_id
     */
    public function setTypeId($type_id): self
    {
        $this->type_id = $type_id;

        return $this;
    }
}
