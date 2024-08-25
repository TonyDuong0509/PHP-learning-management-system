<?php

namespace App\Services;

use App\Repositories\QuestionsRepository;

class QuestionsService
{
    private $questionsRepository;

    public function __construct(QuestionsRepository $questionsRepository)
    {
        $this->questionsRepository = $questionsRepository;
    }

    public function saveQuestion($params)
    {
        return $this->questionsRepository->save($params);
    }

    public function getAllQuestions()
    {
        return $this->questionsRepository->fetchAll();
    }

    public function replayByParentId($parentId, $courseId)
    {
        $condition = "parent_id = '$parentId' AND course_id = '$courseId' ORDER BY id ASC";
        return $this->questionsRepository->fetchAll($condition);
    }

    public function getAllByInstructorIdAndParentId($instructor_id)
    {
        return $this->questionsRepository->getAllByInstructorIdAndParentId($instructor_id);
    }

    public function getAllForOneCourseQAndA($user_id, $course_id)
    {
        $condition = "user_id = '$user_id' AND course_id = '$course_id' AND parent_id = 0 ORDER BY id ASC";
        return $this->questionsRepository->fetchAll($condition);
    }

    public function getById($id)
    {
        return $this->questionsRepository->getById($id);
    }
}
