<?php

namespace App\Controllers\User;

use App\Services\CartService;
use App\Services\CategoryService;
use App\Services\CouponService;
use App\Services\CourseService;
use App\Services\SubCategoryService;
use App\Services\UserService;

class CartController
{
    private $courseService;
    private $cartService;
    private $categoryService;
    private $subCategoryService;
    private $couponService;
    private $userService;

    public function __construct(
        CourseService $courseService,
        CartService $cartService,
        CategoryService $categoryService,
        SubCategoryService $subCategoryService,
        CouponService $couponService,
        UserService $userService,
    ) {
        $this->courseService = $courseService;
        $this->cartService = $cartService;
        $this->categoryService = $categoryService;
        $this->subCategoryService = $subCategoryService;
        $this->couponService = $couponService;
        $this->userService = $userService;
    }

    public function addToCart($id)
    {
        $course = $this->courseService->getById($id);

        if (isset($_SESSION['coupon']) || !empty($_SESSION['coupon'])) {
            unset($_SESSION['coupon']);
        }

        $cartItem = $this->cartService->checkExistCourse($course->getId());
        if ($cartItem !== false) {
            echo json_encode(['error' => 'Course is already on your cart']);
            exit;
        }

        if ($course->getDiscountPrice() == 0) {
            $paramsNotDiscount = [
                'course_id' => $id,
                'name' => $_POST['name'],
                'qty' => 1,
                'price' => $course->getSellingPrice(),
                'weight' => 1,
                'image' => $course->getImage(),
                'slug' => $_POST['slug'],
                'instructorId' => $_POST['instructorId'],
            ];
            $this->cartService->saveCart($paramsNotDiscount);
        } else if ($course->getDiscountPrice() != 0) {
            $amount = $course->getSellingPrice() - $course->getDiscountPrice();
            $paramsDiscount = [
                'course_id' => $id,
                'name' => $_POST['name'],
                'qty' => 1,
                'price' => $amount,
                'weight' => 1,
                'image' => $course->getImage(),
                'slug' => $_POST['slug'],
                'instructorId' => $_POST['instructorId'],
            ];
            $this->cartService->saveCart($paramsDiscount);
        }

        echo json_encode(['success' => 'Successfully added on your cart']);
        exit;
    }

    public function cartData()
    {
        $carts = $this->cartService->getAll();
        $cartTotal = $this->cartService->total();
        $cartQty = count($this->cartService->getAll());

        echo json_encode(
            array(
                'carts' => $carts,
                'cartTotal' => $cartTotal,
                'cartQty' => $cartQty,
            ),
        );
        exit;
    }

    public function addMiniCart()
    {
        return $this->cartData();
    }

    public function myCart()
    {
        $cartTotals = $this->cartService->total();
        $categories = $this->categoryService->getAllCategories();
        $subCategories = [];

        for ($i = 0; $i < count($categories); $i++) {
            $category_id = $categories[$i]->getId();
            $subCategories[$category_id] = $this->subCategoryService->getByCategoryId($category_id);
        }

        require ABSPATH . 'resources/user/mycart/mycart.php';
    }

    public function getCartCourse()
    {
        return $this->cartData();
    }

    public function cartRemove($id)
    {
        $result = $this->cartService->delete($id);

        if (isset($_SESSION['coupon']) || !empty($_SESSION['coupon'])) {
            $coupon_name =  $_SESSION['coupon']['coupon_name'];
            $coupon = $this->couponService->getCouponNameAndCheckExpire($coupon_name);

            $_SESSION['coupon'] = [
                'coupon_name' => $coupon->getCouponName(),
                'coupon_discount' => $coupon->getCouponDiscount(),
                'discount_amount' => round($this->cartService->total() * $coupon->getCouponDiscount() / 100),
                'total_amount' => round($this->cartService->total() - ($this->cartService->total() * $coupon->getCouponDiscount() / 100)),
            ];
        }

        if ($result) {
            echo json_encode(['success' => "Course removed from cart"]);
            exit;
        } else {
            echo json_encode(['error' => "Removed unsuccessfully, please try again"]);
            exit;
        }
    }

    public function applyCoupon()
    {
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
        $coupon_name = $data['coupon_name'];

        $coupon = $this->couponService->getCouponNameAndCheckExpire($coupon_name);
        if ($coupon) {
            $_SESSION['coupon'] = [
                'coupon_name' => $coupon->getCouponName(),
                'coupon_discount' => $coupon->getCouponDiscount(),
                'discount_amount' => round($this->cartService->total() * $coupon->getCouponDiscount() / 100),
                'total_amount' => round($this->cartService->total() - ($this->cartService->total() * $coupon->getCouponDiscount() / 100)),
            ];

            echo json_encode([
                'validity' => true,
                'success' => 'Applied Coupon successfully',
            ]);
            exit;
        } else {
            echo json_encode(['error' => 'Invalid Coupon or Coupon is expired']);
            exit;
        }
    }

    public function couponCalculation()
    {
        if (isset($_SESSION['coupon']) || !empty($_SESSION['coupon'])) {
            echo json_encode([
                'subtotal' => $this->cartService->total(),
                'coupon_name' => $_SESSION['coupon']['coupon_name'],
                'coupon_discount' => $_SESSION['coupon']['coupon_discount'],
                'discount_amount' => $_SESSION['coupon']['discount_amount'],
                'total_amount' => $_SESSION['coupon']['total_amount'],
            ]);
            exit;
        } else {
            echo json_encode(['total' => $this->cartService->total()]);
            exit;
        }
    }

    public function couponRemove()
    {
        unset($_SESSION['coupon']);
        echo json_encode(['success' => 'Removed Coupon successfully']);
    }

    public function checkoutCreate()
    {
        $email = $_SESSION['emailUser'] ?? '';
        $user = $this->userService->getByEmail($email);

        if ($user) {
            if ($this->cartService->total() > 0) {
                $carts = $this->cartService->getAll();
                $cartTotal = $this->cartService->total();
                $cartQty = count($this->cartService->getAll());

                require ABSPATH . 'resources/user/checkout/checkoutView.php';
            } else {
                header("Location: /mycart?error=1");
                exit;
            }
        } else {
            header("Location: /mycart?error=2");
            exit;
        }
    }
}
