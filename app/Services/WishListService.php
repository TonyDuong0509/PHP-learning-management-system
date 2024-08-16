<?php

namespace App\Services;

use App\Repositories\WishListRepository;

class WishListService
{
    private $wishListRepository;

    public function __construct(WishListRepository $wishListRepository)
    {
        $this->wishListRepository = $wishListRepository;
    }

    public function saveWishList($params)
    {
        return $this->wishListRepository->save($params);
    }

    public function checkCourseExist($id)
    {
        return $this->wishListRepository->checkCourseExist($id);
    }

    public function getWishListsCoursesSameUserId($id)
    {
        return $this->wishListRepository->getWishListsCourseSameUserId($id);
    }

    public function deleteWishList($user_id, $id)
    {
        return $this->wishListRepository->delete($user_id, $id);
    }
}
