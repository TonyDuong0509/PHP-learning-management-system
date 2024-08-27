<?php

namespace App\Services;

use App\Repositories\ReviewRepository;

class ReviewService
{
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function saveReview($params)
    {
        return $this->reviewRepository->save($params);
    }

    public function getAllByCourseId($course_id)
    {
        return $this->reviewRepository->getAllByCourseId($course_id);
    }

    public function getAverageRatingByCourseId($course_id)
    {
        return $this->reviewRepository->getAverageRatingByCourseId($course_id);
    }
}
