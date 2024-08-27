<?php

namespace App\Services;

use App\Repositories\PaymentsRepository;

class PaymentsService
{
    private $paymentRepository;

    public function __construct(PaymentsRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function savePayment($params)
    {
        return $this->paymentRepository->save($params);
    }

    public function getAllPayments()
    {
        return $this->paymentRepository->fetchAll();
    }

    public function getStatusPayment($status)
    {
        $condition = "status = '$status' ORDER BY id DESC";

        return $this->paymentRepository->fetchAll($condition);
    }

    public function getById($id)
    {
        return $this->paymentRepository->getById($id);
    }

    public function updateStatus($payment)
    {
        return $this->paymentRepository->updateStatus($payment);
    }

    public function getAllByDate($order_date)
    {
        return $this->paymentRepository->getAllByDateTimeType('order_date', $order_date);
    }

    public function getAllByMonth($order_month, $oder_year)
    {
        return $this->paymentRepository->getAllByMonth($order_month, $oder_year);
    }

    public function getAllByYear($order_year)
    {
        return $this->paymentRepository->getAllByDateTimeType('order_year', $order_year);
    }
}
