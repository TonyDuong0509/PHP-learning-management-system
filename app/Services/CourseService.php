<?php

namespace App\Services;

use App\Repositories\CourseRepository;

class CourseService
{
    private $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function getAllCourses()
    {
        $condition = "id != '' ORDER BY id DESC";

        return $this->courseRepository->fetchAll();
    }

    public function getCoursesSameCid($id)
    {
        $condition = "category_id = '$id' AND status = '1' ORDER BY id DESC";

        return $this->courseRepository->fetchAll($condition);
    }

    public function getCoursesSameSubCid($id)
    {
        $condition = "subcategory_id = '$id' AND status = '1' ORDER BY id DESC";

        return $this->courseRepository->fetchAll($condition);
    }

    public function getCoursesSameInstructorId($id)
    {
        $condition = "instructor_id = '$id' AND status = '1' ORDER BY id DESC";

        return $this->courseRepository->fetchAll($condition);
    }

    public function getById($id)
    {
        return $this->courseRepository->getById($id);
    }

    public function saveCourse($params)
    {
        return $this->courseRepository->save($params);
    }

    public function updateCourse($course)
    {
        return $this->courseRepository->update($course);
    }

    public function deleteCourse($id)
    {
        return $this->courseRepository->delete($id);
    }

    public function handleImageFile($path, $inputName)
    {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == 0) {
            $targetDir = "../public/upload/course/$path/";
            $imageFileName = 'course_thumbnail' . bin2hex(random_bytes(16)) . '.' . strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));
            $extension = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
            $targetFile = $targetDir . $imageFileName;
            $allowedExtenions = array('jpg', 'jpeg', 'png');

            if (in_array($extension, $allowedExtenions)) {
                if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetFile)) {
                    return $targetFile;
                } else {
                    $_SESSION['notification'] = [
                        'message' => "Upload image failed, please try again",
                        'alert-type' => 'error',
                    ];
                    header("Location: /instructor/add-course");
                    exit;
                }
            } else {
                $_SESSION['notification'] = [
                    'message' => "Images have to be JPG, JPEG, PNG",
                    'alert-type' => 'error',
                ];
                header("Location: /instructor/add-course");
                exit;
            }
        }
    }

    public function handleVideoFile($path, $inputName)
    {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == 0) {
            $targetDir = "../public/upload/course/$path/";
            $videoFileName = 'course_video' . bin2hex(random_bytes(16)) . '.' . strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));
            $extension = strtolower(pathinfo($videoFileName, PATHINFO_EXTENSION));
            $targetVideo = $targetDir . $videoFileName;
            $allowedExtenions = array('mp4', 'avi', 'mov', 'mkv');
            $allowedMimeTypes = array('video/mp4', 'video/x-msvideo', 'video/quicktime', 'video/x-matroska');

            $mimeType = mime_content_type($_FILES[$inputName]['tmp_name']);

            if (in_array($extension, $allowedExtenions) && in_array($mimeType, $allowedMimeTypes)) {
                if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetVideo)) {
                    return $targetVideo;
                } else {
                    $_SESSION['notification'] = [
                        'message' => "Upload video failed, please try again",
                        'alert-type' => 'error',
                    ];
                    header("Location: /instructor/add-course");
                    exit;
                }
            } else {
                $_SESSION['notification'] = [
                    'message' => "Video have to be MP4, MP3, VD",
                    'alert-type' => 'error',
                ];
                header("Location: /instructor/add-course");
                exit;
            }
        }
    }
}
