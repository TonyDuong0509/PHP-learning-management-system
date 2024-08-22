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

    public function getById($id)
    {
        return $this->paymentRepository->getById($id);
    }
}
