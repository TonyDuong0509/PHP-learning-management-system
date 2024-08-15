<?php

namespace App\Repositories;

use App\Models\CourseLectures;
use App\Repositories\Interfaces\CourseLecturesRepositoryInterface;

class CourseLecturesRepository implements CourseLecturesRepositoryInterface
{
    public function fetchAll($condition = null)
    {
        global $conn;
        $courseLectures = array();
        $sql = "SELECT * FROM course_lectures";

        if ($condition) {
            $sql .= " WHERE $condition";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $courseLecture = new CourseLectures(
                    $row['id'],
                    $row['course_id'],
                    $row['section_id'],
                    $row['lecture_title'],
                    $row['video'],
                    $row['url'],
                    $row['content'],
                    $row['created_at']
                );
                $courseLectures[] = $courseLecture;
            }
        }

        return $courseLectures;
    }

    public function getLecturesBySectionId($id)
    {
        $condition = "section_id = '$id'";
        return $this->fetchAll($condition);
    }

    public function save($params)
    {
        global $conn;

        $course_id = $params['course_id'];
        $section_id = $params['section_id'];
        $lecture_title = $conn->real_escape_string($params['lecture_title']);
        $video = $params['video'];
        $url = $conn->real_escape_string($params['url']);
        $content = $conn->real_escape_string($params['content']);
        $created_at = $params['created_at'];

        $sql = "INSERT INTO course_lectures (course_id, section_id, lecture_title, video, url, content, created_at)
                VALUES ('$course_id', '$section_id', '$lecture_title', '$video', '$url', '$content', '$created_at')";

        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            return $last_id;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }

    public function getLectureBySectionId($id)
    {
        $condition = "section_id = '$id'";
        $courseLectures = $this->fetchAll($condition);
        $lecture = current($courseLectures);
        return $lecture;
    }

    public function getById($id)
    {
        $condition = "id = '$id'";
        $courseLectures = $this->fetchAll($condition);
        $lecture = current($courseLectures);
        return $lecture;
    }
    public function update($lecture)
    {
        global $conn;

        $id = $lecture->getId();
        $lecture_title = $conn->real_escape_string($lecture->getLectureTitle());
        $url = $conn->real_escape_string($lecture->getUrl());
        $content = $conn->real_escape_string($lecture->getContent());

        $sql = "UPDATE course_lectures
                SET lecture_title = '$lecture_title', url = '$url', content = '$content'
                WHERE id = '$id'";

        if ($conn->query($sql) === true) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }
    public function delete($id)
    {
        global $conn;
        $sql = "DELETE FROM course_lectures
                WHERE id = '$id'";

        if ($conn->query($sql) === true) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }
}
