<?php

namespace App\Controllers\User;

use App\Repositories\OrdersRepository;
use App\Services\CartService;
use App\Services\ReviewService;
use App\Services\UserService;
use App\Services\WishListService;

class WishListController
{
    private $userService;
    private $wishListService;
    private $cartService;

    public function __construct(
        UserService $userService,
        WishListService $wishListService,
        CartService $cartService,
    ) {
        $this->userService = $userService;
        $this->wishListService = $wishListService;
        $this->cartService = $cartService;
    }

    private function getHeaderProfile()
    {
        $email = $_SESSION['user']['email'] ?? '';
        return $this->userService->getByEmail($email);
    }

    public function allWishList()
    {
        $user = $this->getHeaderProfile();
        $cartTotal = $this->cartService->total();
        $carts = $this->cartService->getAll();
        $wishlists = $this->wishListService->getWishListsCoursesSameUserId($user->getId());

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
