<?php

namespace App\Repositories\Interfaces;

interface WishListRepositoryInterface
{
    public function fetchAll($condition = null);
    public function save($params);
    public function checkCourseExist($id);
    public function getWishListsCourseSameUserId($user_id);
    public function delete($user_id, $id);
}
