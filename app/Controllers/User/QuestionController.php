<?php

namespace App\Controllers\User;

use App\Services\QuestionsService;
use App\Services\UserService;
use DateTime;
use DateTimeZone;

class QuestionController
{
    private $userService;
    private $questionsService;

    public function __construct(
        UserService $userService,
        QuestionsService $questionsService,
    ) {
        $this->userService = $userService;
        $this->questionsService = $questionsService;
    }

    private function getInstructorInSidebar()
    {
        $email = $_SESSION['emailInstructor'];
        return $this->userService->getByEmail($email);
    }

    private function getDateTime()
    {
        $date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
        return $date->format('Y-m-d H:i:s');
    }

    public function userQuestion()
    {
        $course_id = $_POST['course_id'] ?? '';
        $instructor_id = $_POST['instructor_id'] ?? '';
        $email = $_SESSION['emailUser'];
        $user = $this->userService->getByEmail($email);

        $params = [
            'course_id' => $course_id,
            'user_id' => $user->getId(),
            'instructor_id' => $instructor_id,
            'subject' => $_POST['subject'],
            'question' => $_POST['question'],
            'created_at' => $this->getDateTime(),
        ];

        $this->questionsService->saveQuestion($params);

        $_SESSION['notification'] = [
            'message' => 'Message Send Successfully',
            'alert-type' => 'success',
        ];

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function instructorAllQuestion()
    {
        $instructor = $this->getInstructorInSidebar();
        $questions = $this->questionsService->getAllByInstructorIdAndParentId($instructor->getId());

        require ABSPATH . 'resources/instructor/question/allQuestion.php';
    }

    public function questionDetails($id)
    {
        $instructor = $this->getInstructorInSidebar();
        $question = $this->questionsService->getById($id);
        $replay = $this->questionsService->replayByParentId($id, $question->getCourseId());

        require ABSPATH . 'resources/instructor/question/questionDetails.php';
    }

    public function instructorReply()
    {
        $question_id = $_POST['question_id'] ?? '';
        $user_id = $_POST['user_id'] ?? '';
        $course_id = $_POST['course_id'] ?? '';
        $instructor_id = $_POST['instructor_id'] ?? '';
        $question = $_POST['question'] ?? '';

        $params = [
            'course_id' => $course_id,
            'user_id' => $user_id,
            'instructor_id' => $instructor_id,
            'parent_id' => $question_id,
            'question' => $question,
            'created_at' => $this->getDateTime(),
        ];

        $this->questionsService->saveQuestion($params);

        $_SESSION['notification'] = [
            'message' => 'Message Send Successfully',
            'alert-type' => 'success',
        ];

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
