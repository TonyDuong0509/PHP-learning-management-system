<?php

namespace App\Controllers\Admin;

use App\Services\CourseLecturesService;
use App\Services\CourseSectionsService;
use App\Services\OrdersService;
use App\Services\PaymentsService;
use App\Services\QuestionsService;
use App\Services\UserService;

class OrderController
{
    private $userService;
    private $paymentsService;
    private $orderService;
    private $courseSectionService;
    private $courseLecturesService;
    private $questionsService;

    public function __construct(
        UserService $userService,
        PaymentsService $paymentsService,
        OrdersService $orderService,
        CourseSectionsService $courseSectionService,
        CourseLecturesService $courseLecturesService,
        QuestionsService $questionsService,
    ) {
        $this->userService = $userService;
        $this->paymentsService = $paymentsService;
        $this->orderService = $orderService;
        $this->courseSectionService = $courseSectionService;
        $this->courseLecturesService = $courseLecturesService;
        $this->questionsService = $questionsService;
    }

    private function getInfoHeader()
    {
        $email = $_SESSION['admin']['email'];
        return $this->userService->getByEmail($email);
    }

    public function adminPendingOrder()
    {
        $admin = $this->getInfoHeader();
        $payments = $this->paymentsService->getStatusPayment('pending');

        require ABSPATH . 'resources/admin/orders/pendingOrders.php';
    }

    public function adminOrderDetails($id)
    {
        $admin = $this->getInfoHeader();
        $payment = $this->paymentsService->getById($id);
        $orderItem = $this->orderService->getAllByPaymentId($payment->getId());

        require ABSPATH . 'resources/admin/orders/orderDetails.php';
    }

    public function pendingConfirmByInstructor($id)
    {
        $payment = $this->paymentsService->getById($id);
        $this->paymentsService->updateStatus($payment);

        $_SESSION['notification'] = [
            'message' => "Order Confirmed successfully",
            'alert-type' => 'success',
        ];

        header("Location: /instructor/all/order");
        exit;
    }

    public function pendingConfirmByAdmin($id)
    {
        $payment = $this->paymentsService->getById($id);
        $this->paymentsService->updateStatus($payment);

        $_SESSION['notification'] = [
            'message' => "Order Confirmed successfully",
            'alert-type' => 'success',
        ];

        header("Location: /admin/confirm/order");
        exit;
    }

    public function adminConfirmOrder()
    {
        $admin = $this->getInfoHeader();
        $payments = $this->paymentsService->getStatusPayment('confirm');

        require ABSPATH . 'resources/admin/orders/confirmOrders.php';
    }

    private function getInstructorInSidebar()
    {
        $email = $_SESSION['instructor']['email'];
        return $this->userService->getByEmail($email);
    }

    public function instructorAllOrder()
    {
        $instructor = $this->getInstructorInSidebar();
        $orderItem = $this->orderService->getOrdersLatestByPaymentIdAndInstructorId($instructor->getId());
        require ABSPATH . 'resources/instructor/order/allOrder.php';
    }

    public function instructorOrderDetails($payment_id)
    {
        $instructor = $this->getInstructorInSidebar();
        $payment = $this->paymentsService->getById($payment_id);
        $orderItem = $this->orderService->getAllByPaymentId($payment_id);
        require ABSPATH . 'resources/instructor/order/orderDetails.php';
    }

    public function myCourse()
    {
        $email = $_SESSION['user']['email'];
        $user = $this->userService->getByEmail($email);
        $myCourse = $this->orderService->getOrdersLatestByCourseIdAndUserId($user->getId());

        require ABSPATH . 'resources/user/dashboard/mycourse/myAllCourse.php';
    }

    public function courseView($course_id)
    {
        $email = $_SESSION['user']['email'];
        $user = $this->userService->getByEmail($email);
        $course = $this->orderService->getCourseInOrderByUserIdAndCourseId($course_id, $user->getId());
        $sections = $this->courseSectionService->getSectionsByCourseId($course_id);
        $lectures = $this->courseLecturesService->getLecturesBySectionId($sections[0]->getId());
        $questionsOfCourse = $this->questionsService->getAllForOneCourseQAndA($user->getId(), $course_id);
        foreach ($questionsOfCourse as $question) {
            $replies = $this->questionsService->replayByParentId($question->getId(), $course_id);
        }

        require ABSPATH . 'resources/user/dashboard/mycourse/courseView.php';
    }
}
