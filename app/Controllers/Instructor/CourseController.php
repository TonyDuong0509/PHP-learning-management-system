<?php

namespace App\Controllers\Instructor;

use App\Services\CategoryService;
use App\Services\CourseGoalsService;
use App\Services\CourseLecturesService;
use App\Services\CourseSectionsService;
use App\Services\CourseService;
use App\Services\CourseTypesService;
use App\Services\SubCategoryService;
use App\Services\UserService;

class CourseController
{
    private $courseService;
    private $userService;
    private $categoryService;
    private $subCategoryService;
    private $courseGoalsService;
    private $courseSectionsService;
    private $courseLecturesService;
    private $courseTypesService;

    public function __construct(
        CourseService $courseService,
        UserService $userService,
        CategoryService $categoryService,
        SubCategoryService $subCategoryService,
        CourseGoalsService $courseGoalsService,
        CourseSectionsService $courseSectionsService,
        CourseLecturesService $courseLecturesService,
        CourseTypesService $courseTypesService,
    ) {
        $this->courseService = $courseService;
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->subCategoryService = $subCategoryService;
        $this->courseGoalsService = $courseGoalsService;
        $this->courseSectionsService = $courseSectionsService;
        $this->courseLecturesService = $courseLecturesService;
        $this->courseTypesService = $courseTypesService;
    }

    private function getInstructorInSidebar()
    {
        $email = $_SESSION['instructor']['email'];
        return $this->userService->getByEmail($email);
    }

    public function manageCourse()
    {
        $instructor = $this->getInstructorInSidebar();
        $courses = $this->courseService->getAllCourses();

        require ABSPATH . 'resources/instructor/course/manageCourse.php';
    }

    public function addCourse()
    {
        $instructor = $this->getInstructorInSidebar();
        $categories = $this->categoryService->getAllCategories();
        $types = $this->courseTypesService->getAllTypes();

        require ABSPATH . 'resources/instructor/course/addCourse.php';
    }

    public function subCategoryAjax($cid)
    {
        $subCategories = $this->subCategoryService->getByCategoryId($cid);

        $subCategoryArray = array_map(function ($subcategory) {
            return $subcategory->toArray();
        }, $subCategories);

        echo json_encode($subCategoryArray);
        exit;
    }

    public function storeCourse()
    {
        $params = [
            'category_id' => $_POST['category_id'] ?? '',
            'subcategory_id' => $_POST['subcategory_id'] ?? '',
            'instructor_id' => $_SESSION['instructor']['id'] ?? '',
            'name' => $_POST['course_name'] ?? '',
            'title' => $_POST['course_title'] ?? '',
            'slug' => strtolower(str_replace(' ', '-', $_POST['course_name'])) ?? '',
            'certificate' => $_POST['certificate'] ?? '',
            'label' => $_POST['label'] ?? '',
            'selling_price' => $_POST['selling_price'] ?? '',
            'discount_price' => $_POST['discount_price'] ?? '',
            'duration' => $_POST['duration'] ?? '',
            'resources' => $_POST['resources'] ?? '',
            'prerequisites' => $_POST['prerequisites'] ?? '',
            'description' => $_POST['description'] ?? '',
            'bestseller' => $_POST['bestseller'] ?? '',
            'featured' => $_POST['featured'] ?? '',
            'highestrated' => $_POST['highestrated'] ?? '',
            'created_at' => date('Y-m-d H:i:s'),
            'type_id' => $_POST['type_id'] ?? '',
        ];

        $params['image'] = $this->courseService->handleImageFile('thumbnail', 'course_image');
        $params['video'] = $this->courseService->handleVideoFile('video', 'video');

        $course_id = $this->courseService->saveCourse($params);

        $goals = $_POST['course_goals'];
        if (!empty($goals)) {
            foreach ($goals as $goal) {
                $params2 = [
                    'course_id' => $course_id,
                    'goal_name' => $goal,
                    'created_at' => date('Y-m-d  H:i:s'),
                ];

                $this->courseGoalsService->saveCourseGoals($params2);
            }
        }

        $_SESSION['notification'] = [
            'message' => "Added Course successfully",
            'alert-type' => 'success',
        ];
        header("Location: /instructor/courses");
        exit;
    }

    public function editCourse($id)
    {
        $instructor = $this->getInstructorInSidebar();
        $course = $this->courseService->getById($id);
        $categories = $this->categoryService->getAllCategories();
        $subCategories = $this->subCategoryService->getAllSubCategories();
        $courseGoals = $this->courseGoalsService->getAllByCourseId($id);
        $types = $this->courseTypesService->getAllTypes();

        require ABSPATH . 'resources/instructor/course/editCourse.php';
    }

    public function updateCourse()
    {
        $id = $_POST['course_id'] ?? '';
        $name = $_POST['course_name'] ?? '';
        $slug = strtolower(str_replace(' ', '-', $_POST['course_name']));
        $title = $_POST['course_title'] ?? '';
        $category_id = $_POST['category_id'] ?? '';
        $subcategory_id = $_POST['subcategory_id'] ?? '';
        $certificate = $_POST['certificate'] ?? '';
        $label = $_POST['label'] ?? '';
        $selling_price = $_POST['selling_price'] ?? '';
        $discount_price = $_POST['discount_price'] ?? '';
        $duration = $_POST['duration'] ?? '';
        $resources = $_POST['resources'] ?? '';
        $prerequisites = $_POST['prerequisites'] ?? '';
        $description = $_POST['description'] ?? '';
        $bestseller = $_POST['bestseller'] ?? '';
        $featured = $_POST['featured'] ?? '';
        $highestrated = $_POST['highestrated'] ?? '';
        $type_id = $_POST['type_id'] ?? '';

        $course = $this->courseService->getById($id);

        if ($course) {
            $course->setName($name);
            $course->setTitle($title);
            $course->setSlug($slug);
            $course->setCategoryId($category_id);
            $course->setSubcategoryId($subcategory_id);
            $course->setCertificate($certificate);
            $course->setLabel($label);
            $course->setSellingPrice($selling_price);
            $course->setDiscountPrice($discount_price);
            $course->setDuration($duration);
            $course->setResources($resources);
            $course->setPrerequisuites($prerequisites);
            $course->setDescription($description);
            $course->setBestseller($bestseller);
            $course->setFeatured($featured);
            $course->setHighestrated($highestrated);
            $course->setTypeId($type_id);
        }

        if ($this->courseService->updateCourse($course) === true) {

            $_SESSION['notification'] = [
                'message' => "Updated Course successfully",
                'alert-type' => 'success',
            ];
            header("Location: /instructor/edit-course/$id");
            exit;
        }
    }

    public function updateCourseImage()
    {
        $id = $_POST['course_id'] ?? '';
        $old_img = $_POST['old_img'] ?? '';
        $new_image = $this->courseService->handleImageFile('thumbnail', 'course_image') ?? '';

        if (!empty($old_img)) {
            unlink($old_img);
        }

        $course = $this->courseService->getById($id);

        if ($course) {
            $course->setImage($new_image);
        }

        if ($this->courseService->updateCourse($course) === true) {

            $_SESSION['notification'] = [
                'message' => "Updated Image Course successfully",
                'alert-type' => 'success',
            ];
            header("Location: /instructor/edit-course/$id");
            exit;
        }
    }

    public function updateCourseVideo()
    {
        $id = $_POST['course_id'] ?? '';
        $old_video = $_POST['old_video'] ?? '';
        $video = $this->courseService->handleVideoFile('video', 'video') ?? '';

        if (!empty($old_video)) {
            unlink($old_video);
        }

        $course = $this->courseService->getById($id);

        if ($course) {
            $course->setVideo($video);
        }

        if ($this->courseService->updateCourse($course) === true) {

            $_SESSION['notification'] = [
                'message' => "Updated Video Course successfully",
                'alert-type' => 'success',
            ];
            header("Location: /instructor/edit-course/$id");
            exit;
        }
    }

    public function updateCourseGoals()
    {
        $id = $_POST['course_id'] ?? '';
        $goals = $_POST['course_goals'] ?? '';

        if ($goals == null) {
            header("Location: /instructor/edit-course/$id");
            exit;
        } else {
            $this->courseGoalsService->deleteCourseGoals($id);

            foreach ($goals as $goal) {
                $params = [
                    'course_id' => $id,
                    'goal_name' => $goal,
                    'created_at' => date('Y-m-d  H:i:s'),
                ];

                $this->courseGoalsService->saveCourseGoals($params);
            }

            $_SESSION['notification'] = [
                'message' => "Updatec Goals of Course successfully",
                'alert-type' => 'success',
            ];
            header("Location: /instructor/edit-course/$id");
            exit;
        }
    }

    public function deleteCourse($id)
    {
        $course = $this->courseService->getById($id);

        unlink($course->getImage());
        unlink($course->getVideo());
        $this->courseService->deleteCourse($id);
        $this->courseGoalsService->deleteCourseGoals($id);

        $_SESSION['notification'] = [
            'message' => "Deleted Course successfully",
            'alert-type' => 'success',
        ];
        header("Location: /instructor/courses");
        exit;
    }

    public function addCourseLecture($id)
    {
        $instructor = $this->getInstructorInSidebar();
        $course = $this->courseService->getById($id);
        $section = $this->courseSectionsService->getSectionsByCourseId($id);

        require ABSPATH . 'resources/instructor/course/section/addCourseLecture.php';
    }

    public function storeSection()
    {
        $id = $_POST['id'] ?? '';
        $section_title = $_POST['section_title'] ?? '';

        $params = [
            'course_id' => $id,
            'section_title' => $section_title,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->courseSectionsService->saveCourseSections($params);

        $_SESSION['notification'] = [
            'message' => "Added Section successfully",
            'alert-type' => 'success',
        ];
        header("Location: /instructor/add-course-lecture/$id");
        exit;
    }

    public function storeLecture()
    {
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);

        $course_id = $data['course_id'] ?? '';
        $section_id = $data['section_id'] ?? '';
        $lecture_title = $data['lecture_title'] ?? '';
        $lecture_url = $data['lecture_url'] ?? '';
        $content = $data['content'] ?? '';

        $params = [
            'course_id' => $course_id,
            'section_id' => $section_id,
            'lecture_title' => $lecture_title,
            'video' => null,
            'url' => $lecture_url,
            'content' => $content,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->courseLecturesService->saveCourseLectures($params);

        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
        ]);
        exit;
    }

    public function editCourseLecture($id)
    {
        $instructor = $this->getInstructorInSidebar();
        $section = $this->courseSectionsService->getById($id);
        $lecture = $this->courseLecturesService->getLectureBySectionId($section->getId());

        require ABSPATH . 'resources/instructor/course/lecture/editCourseLecture.php';
    }

    public function updateCourseLecture()
    {
        $id = $_POST['id'] ?? '';
        $lecture_title = $_POST['lecture_title'] ?? '';
        $url = $_POST['url'] ?? '';
        $content = $_POST['content'] ?? '';

        $lecture = $this->courseLecturesService->getById($id);
        $lecture->setLectureTitle($lecture_title);
        $lecture->setUrl($url);
        $lecture->setContent($content);

        if ($this->courseLecturesService->updateLecture($lecture)) {

            $_SESSION['notification'] = [
                'message' => "Updated Lectures of Course successfully",
                'alert-type' => 'success',
            ];
            header("Location: /instructor/edit-course-lecture/{$lecture->getSectionId()}");
            exit;
        }
    }

    public function deleteLecture($id)
    {
        $lecture = $this->courseLecturesService->getLectureBySectionId($id);

        if ($this->courseLecturesService->deleteLecture($lecture->getId())) {

            $_SESSION['notification'] = [
                'message' => "Deleted Lectures successfully",
                'alert-type' => 'success',
            ];
            header("Location: /instructor/add-course-lecture/{$lecture->getCourseId()}");
            exit;
        }
    }

    public function deleteSection($id)
    {
        $section = $this->courseSectionsService->getById($id);
        $course = $this->courseSectionsService->getCourseById($section->getCourseId());
        if ($this->courseSectionsService->deleteSection($id)) {

            $_SESSION['notification'] = [
                'message' => "Deleted Section successfully",
                'alert-type' => 'success',
            ];
            header("Location: /instructor/add-course-lecture/{$course->getCourseId()}");
            exit;
        }
    }
}
