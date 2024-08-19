<?php

namespace App\Controllers\User;

use App\Services\CartService;
use App\Services\CategoryService;
use App\Services\CourseService;
use App\Services\SubCategoryService;
use App\Services\UserService;

class CartController
{
    private $courseService;
    private $cartService;
    private $categoryService;
    private $subCategoryService;

    public function __construct(
        CourseService $courseService,
        CartService $cartService,
        CategoryService $categoryService,
        SubCategoryService $subCategoryService,
    ) {
        $this->courseService = $courseService;
        $this->cartService = $cartService;
        $this->categoryService = $categoryService;
        $this->subCategoryService = $subCategoryService;
    }

    public function addToCart($id)
    {
        $course = $this->courseService->getById($id);
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

    public function removeMiniCart($id)
    {
        $result = $this->cartService->delete($id);
        if ($result) {
            echo json_encode(['success' => "Deleted successfully"]);
            exit;
        } else {
            echo json_encode(['error' => "Deleted unsuccessfully, please try again"]);
            exit;
        }
    }

    public function myCart()
    {
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
        return $this->removeMiniCart($id);
    }
}
