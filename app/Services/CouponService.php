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

    public function getById($id)
    {
        return $this->couponRepository->getById($id);
    }

    public function updateCoupon($coupon)
    {
        return $this->couponRepository->update($coupon);
    }

    public function delete($id)
    {
        return $this->couponRepository->delete($id);
    }
}
