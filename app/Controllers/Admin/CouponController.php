<?php

namespace App\Controllers\Admin;

use App\Services\CouponService;
use App\Services\UserService;
use DateTime;
use DateTimeZone;

class CouponController
{
    private $userService;
    private $couponService;

    public function __construct(
        UserService $userService,
        CouponService $couponService
    ) {
        $this->userService = $userService;
        $this->couponService = $couponService;
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

    public function adminAddCoupon()
    {
        $admin = $this->getInfoHeader();

        require ABSPATH . 'resources/admin/coupon/addCoupon.php';
    }

    public function storeCoupon()
    {
        $coupon_name = $_POST['coupon_name'] ?? '';
        $coupon_discount = $_POST['coupon_discount'] ?? '';
        $coupon_validity = $_POST['coupon_validity'] ?? '';
        $created_at = $this->getDateTime();

        $params = [
            'coupon_name' => $coupon_name,
            'coupon_discount' => $coupon_discount,
            'coupon_validity' => $coupon_validity,
            'created_at' => $created_at,
        ];

        $this->couponService->saveCoupon($params);

        header("Location: /admin/all/coupon?success=1");
        exit;
    }

    public function editCoupon($id)
    {
        $admin = $this->getInfoHeader();
        $coupon = $this->couponService->getById($id);
        $dateNow = $this->getDateTime();

        require ABSPATH . 'resources/admin/coupon/editCoupon.php';
    }

    public function updateCoupon()
    {
        $id = $_POST['id'] ?? '';
        $coupon_name = $_POST['coupon_name'] ?? '';
        $coupon_discount = $_POST['coupon_discount'] ?? '';
        $coupon_validity = $_POST['coupon_validity'] ?? '';
        $created_at = $this->getDateTime();

        $coupon = $this->couponService->getById($id);
        $coupon->setCouponName($coupon_name);
        $coupon->setCouponDiscount($coupon_discount);
        $coupon->setCouponValidity($coupon_validity);
        $coupon->setCreatedAt($created_at);

        $this->couponService->updateCoupon($coupon);

        header("Location: /admin/edit/coupon/$id?success=1");
        exit;
    }

    public function destroyCoupon($id)
    {
        $this->couponService->delete($id);

        header("Location: /admin/all/coupon?success=2");
        exit;
    }
}
