<?php

namespace App\Repositories\Interfaces;

interface CouponRepositoryInterface
{
    public function save($params);
    public function fetchAll($condition = null);
    public function update($coupon);
    public function delete($id);
    public function getById($id);
    public function getCouponNameAndCheckExpire($coupon_name);
}
