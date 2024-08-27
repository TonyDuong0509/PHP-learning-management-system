<?php

namespace App\Controllers\Admin;

use App\Services\ReviewService;
use App\Services\UserService;
use DateTime;
use DateTimeZone;

class ReviewController
{
    private $reviewService;
    private $userService;

    public function __construct(
        ReviewService $reviewService,
        UserService $userService,
    ) {
        $this->reviewService = $reviewService;
        $this->userService = $userService;
    }

    private function getDateTime()
    {
        $date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
        return $date->format('Y-m-d H:i:s');
    }

    public function storeReview()
    {
        $email = $_SESSION['user']['email'] ?? '';
        $user = $this->userService->getByEmail($email);
        $course_id = $_POST['course_id'];
        $instructor_id = $_POST['instructor_id'];

        $params = [
            'course_id' => $course_id,
            'user_id' => $user->getId(),
            'instructor_id' => $instructor_id,
            'comment' => $_POST['comment'],
            'rating' => $_POST['rate'],
            'status' => 1,
            'created_at' => $this->getDateTime(),
        ];

        $this->reviewService->saveReview($params);

        $_SESSION['notification'] = [
            'message' => 'Reviewed course successfully',
            'alert-type' => 'success'
        ];

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
