<?php

namespace App\Models;

use App\Repositories\CourseLecturesRepository;

class CourseLectures
{
    protected $id;
    protected $course_id;
    protected $section_id;
    protected $lecture_title;
    protected $video;
    protected $url;
    protected $content;
    protected $created_at;

    public function __construct($id, $course_id, $section_id, $lecture_title, $video, $url, $content, $created_at)
    {
        $this->id = $id;
        $this->course_id = $course_id;
        $this->section_id = $section_id;
        $this->lecture_title = $lecture_title;
        $this->video = $video;
        $this->url = $url;
        $this->content = $content;
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
     * Get the value of section_id
     */
    public function getSectionId()
    {
        return $this->section_id;
    }

    /**
     * Set the value of section_id
     */
    public function setSectionId($section_id): self
    {
        $this->section_id = $section_id;

        return $this;
    }

    /**
     * Get the value of lecture_title
     */
    public function getLectureTitle()
    {
        return $this->lecture_title;
    }

    /**
     * Set the value of lecture_title
     */
    public function setLectureTitle($lecture_title): self
    {
        $this->lecture_title = $lecture_title;

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
     * Get the value of url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of url
     */
    public function setUrl($url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     */
    public function setContent($content): self
    {
        $this->content = $content;

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
