<?php

namespace App\Controllers\Admin;

use App\Services\PaymentsService;
use App\Services\UserService;
use DateTime;

class ReportController
{
    private $userService;
    private $paymentService;

    public function __construct(
        UserService $userService,
        PaymentsService $paymentService
    ) {
        $this->userService = $userService;
        $this->paymentService = $paymentService;
    }

    private function getInfoHeader()
    {
        $email = $_SESSION['admin']['email'];
        return $this->userService->getByEmail($email);
    }

    public function reportView()
    {
        $admin = $this->getInfoHeader();

        require ABSPATH . 'resources/admin/report/reportView.php';
    }

    public function searchByDate()
    {
        $admin = $this->getInfoHeader();
        $date = new DateTime($_POST['date']);
        $formatDate = $date->format('d F Y');
        $payments = $this->paymentService->getAllByDate($formatDate);

        require ABSPATH . 'resources/admin/report/reportByDate.php';
    }

    public function searchByMonth()
    {
        $admin = $this->getInfoHeader();
        $month = $_POST['month'];
        $year = $_POST['year_name'];
        $payments = $this->paymentService->getAllByMonth($month, $year);

        require ABSPATH . 'resources/admin/report/reportByMonth.php';
    }

    public function searchByYear()
    {
        $admin = $this->getInfoHeader();
        $year = $_POST['year'];
        $payments = $this->paymentService->getAllByYear($year);

        require ABSPATH . 'resources/admin/report/reportByYear.php';
    }
}
