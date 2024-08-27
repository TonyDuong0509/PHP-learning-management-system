<?php

namespace App\Controllers\Admin;

use App\Services\CouponService;
use App\Services\CourseService;
use App\Services\UserService;
use DateTime;
use DateTimeZone;

class CouponController
{
    private $userService;
    private $couponService;
    private $courseService;

    public function __construct(
        UserService $userService,
        CouponService $couponService,
        CourseService $courseService,
    ) {
        $this->userService = $userService;
        $this->couponService = $couponService;
        $this->courseService = $courseService;
    }

    private function getDateTime()
    {
        $date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
        return $date->format('Y-m-d H:i:s');
    }

    private function getInfoHeader()
    {
        $email = $_SESSION['admin']['email'];
        return $this->userService->getByEmail($email);
    }

    public function adminAllCoupon()
    {
        $admin = $this->getInfoHeader();
        $coupons = $this->couponService->getAllCoupons();

        require ABSPATH . 'resources/admin/coupon/allCoupon.php';
    }

    public function activeCoupon($id)
    {
        $this->couponService->active($id);

        $_SESSION['notification'] = [
            'message' => 'Actived Coupon successfully',
            'alert-type' => 'success'
        ];

        header("Location: /admin/all/coupon");
        exit;
    }

    public function inactiveCoupon($id)
    {

        $this->couponService->inactive($id);

        $_SESSION['notification'] = [
            'message' => 'In active Coupon successfully',
            'alert-type' => 'success'
        ];

        header("Location: /admin/all/coupon");
        exit;
    }

    public function destroyCoupon($id)
    {
        $this->couponService->delete($id);

        $_SESSION['notification'] = [
            'message' => 'Deleted Coupon successfully',
            'alert-type' => 'success'
        ];
        header("Location: /admin/all/coupon");
        exit;
    }

    public function instructorDeleteCoupon($id)
    {
        $this->couponService->delete($id);

        $_SESSION['notification'] = [
            'message' => 'Deleted Coupon successfully',
            'alert-type' => 'success'
        ];
        header("Location: /instructor/all/coupon");
        exit;
    }

    public function instructorAllCoupon()
    {
        $email = $_SESSION['instructor']['email'] ?? '';
        $instructor = $this->userService->getByEmail($email);
        $coupons = $this->couponService->getAllCouponsOfInstructor($instructor->getId());

        require ABSPATH . 'resources/instructor/coupon/allCoupon.php';
    }

    public function instructorAddCoupon()
    {
        $email = $_SESSION['instructor']['email'] ?? '';
        $instructor = $this->userService->getByEmail($email);
        $courses = $this->courseService->getCoursesSameInstructorId($instructor->getId());

        require ABSPATH . 'resources/instructor/coupon/addCoupon.php';
    }

    public function instructorStoreCoupon()
    {
        $email = $_SESSION['instructor']['email'] ?? '';
        $instructor = $this->userService->getByEmail($email);

        $params = [
            'coupon_name' => $_POST['coupon_name'],
            'coupon_discount' => $_POST['coupon_discount'],
            'coupon_validity' => $_POST['coupon_validity'],
            'instructor_id' => $instructor->getId(),
            'course_id' => $_POST['course_id'],
            'status' => 0,
            'created_at' => $this->getDateTime(),
        ];

        $this->couponService->saveCoupon($params);

        $_SESSION['notification'] = [
            'message' => 'Added Coupon successfully, please waiting admin active it',
            'alert-type' => 'success'
        ];

        header("Location: /instructor/all/coupon");
        exit;
    }

    public function instructorEditCoupon($id)
    {
        $email = $_SESSION['instructor']['email'] ?? '';
        $instructor = $this->userService->getByEmail($email);
        $coupon = $this->couponService->getById($id);
        $courses = $this->courseService->getCoursesSameInstructorId($coupon->getInstructorId());

        require ABSPATH . 'resources/instructor/coupon/editCoupon.php';
    }

    public function instructorUpdateCoupon()
    {
        $id = $_POST['coupon_id'] ?? '';
        $coupon_name = $_POST['coupon_name'] ?? '';
        $coupon_discount = $_POST['coupon_discount'] ?? '';
        $coupon_validity = $_POST['coupon_validity'] ?? '';
        $course_id = $_POST['course_id'] ?? '';
        $created_at = $this->getDateTime();

        $coupon = $this->couponService->getById($id);
        $coupon->setCouponName($coupon_name);
        $coupon->setCouponDiscount($coupon_discount);
        $coupon->setCouponValidity($coupon_validity);
        $coupon->setCourseId($course_id);
        $coupon->setCreatedAt($created_at);

        $this->couponService->updateCoupon($coupon);

        $_SESSION['notification'] = [
            'message' => 'Updated Coupon successfully',
            'alert-type' => 'success'
        ];

        header("Location: /instructor/edit/coupon/$id");
        exit;
    }
}
