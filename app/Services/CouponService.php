<?php

namespace App\Services;

use App\Repositories\CouponRepository;

class CouponService
{
    private $couponRepository;

    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function saveCoupon($params)
    {
        return $this->couponRepository->save($params);
    }

    public function getAllCoupons()
    {
        $condition = "id != ''";
        return $this->couponRepository->fetchAll($condition);
    }

    public function getAllCouponsOfInstructor($instructor_id)
    {
        return $this->couponRepository->getAllCouponsOfInstructor($instructor_id);
    }

    public function getById($id)
    {
        return $this->couponRepository->getById($id);
    }

    public function updateCoupon($coupon)
    {
        return $this->couponRepository->update($coupon);
    }

    public function active($id)
    {
        return $this->couponRepository->active(1, $id);
    }

    public function inactive($id)
    {
        return $this->couponRepository->active(0, $id);
    }

    public function delete($id)
    {
        return $this->couponRepository->delete($id);
    }

    public function getCouponNameAndCheckExpire($coupon_name)
    {
        return $this->couponRepository->getCouponNameAndCheckExpire($coupon_name);
    }
}
