<?php

namespace App\Controllers\User;

use App\Services\UserService;
use App\Services\WishListService;

class WishListController
{
    private $userService;
    private $wishListService;

    public function __construct(
        UserService $userService,
        WishListService $wishListService
    ) {
        $this->userService = $userService;
        $this->wishListService = $wishListService;
    }

    public function allWishList()
    {
        require ABSPATH . 'resources/user/dashboard/allWishList.php';
    }

    public function addToWishList($course_id)
    {
        $email = $_SESSION['user']['email'] ?? '';
        $user = $this->userService->getByEmail($email);

        if ($this->userService->authCheck($email)) {
            $courseExist = $this->wishListService->checkCourseExist($course_id);
            if (!$courseExist) {
                $params = [
                    'user_id' => $user->getId(),
                    'course_id' => $course_id,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                $wishList = $this->wishListService->saveWishList($params);

                echo json_encode(['success' => 'Successfully added on your wishlist']);
                exit;
            }
            echo json_encode(['error' => 'This course has already on your wishlist']);
            exit;
        } else {
            echo json_encode(['error' => 'You have to login before adding to your wishlist']);
            exit;
        }
    }

    public function getWishListsCourse()
    {
        $email = $_SESSION['user']['email'] ?? '';
        $user = $this->userService->getByEmail($email);
        $wishListsCourse = $this->wishListService->getWishListsCoursesSameUserId($user->getId());
        $wishQty = count($wishListsCourse);

        echo json_encode([
            'wishlist' => $wishListsCourse,
            'wishQty' => $wishQty
        ]);
        exit;
    }

    public function removeWishList($id)
    {
        $email = $_SESSION['user']['email'] ?? '';

        if ($this->userService->authCheck($email)) {
            $user = $this->userService->getByEmail($email);
            if ($this->wishListService->deleteWishList($user->getId(), $id)) {
                echo json_encode(['success' => 'Successfully deleted wishlist course']);
                exit;
            } else {
                echo json_encode(['error' => 'Deleted in failing wishlist, please try again']);
                exit;
            }
        } else {
            echo json_encode(['error' => 'You have to login before adding to your wishlist']);
            exit;
        }
    }
}
