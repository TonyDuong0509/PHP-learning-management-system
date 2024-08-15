<?php

namespace App\Models;

use App\Repositories\CourseLecturesRepository;

class CourseSections
{
    protected $id;
    protected $course_id;
    protected $section_title;
    protected $created_at;

    public function __construct($id, $course_id, $section_title, $created_at)
    {
        $this->id = $id;
        $this->course_id = $course_id;
        $this->section_title = $section_title;
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
     * Get the value of section_title
     */
    public function getSectionTitle()
    {
        return $this->section_title;
    }

    /**
     * Set the value of section_title
     */
    public function setSectionTitle($section_title): self
    {
        $this->section_title = $section_title;

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

    public function getLectures()
    {
        $courseLectureRepository = new CourseLecturesRepository();
        return $courseLectureRepository->getLecturesBySectionId($this->id);
    }
}
