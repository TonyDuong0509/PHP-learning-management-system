<?php

namespace App\Models;

class Payments
{
    protected $id;
    protected $name;
    protected $email;
    protected $cash_delivery;
    protected $total_amount;
    protected $payment_type;
    protected $invoice_no;
    protected $order_date;
    protected $order_month;
    protected $order_year;
    protected $status;
    protected $created_at;

    public function __construct(
        $id,
        $name,
        $email,
        $cash_delivery,
        $total_amount,
        $payment_type,
        $invoice_no,
        $order_date,
        $order_month,
        $order_year,
        $status,
        $created_at,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->cash_delivery = $cash_delivery;
        $this->total_amount = $total_amount;
        $this->payment_type = $payment_type;
        $this->invoice_no = $invoice_no;
        $this->order_date = $order_date;
        $this->order_month = $order_month;
        $this->order_year = $order_year;
        $this->status = $status;
        $this->created_at = $created_at;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of cash_delivery
     */
    public function getCashDelivery()
    {
        return $this->cash_delivery;
    }

    /**
     * Set the value of cash_delivery
     */
    public function setCashDelivery($cash_delivery): self
    {
        $this->cash_delivery = $cash_delivery;

        return $this;
    }

    /**
     * Get the value of total_amount
     */
    public function getTotalAmount()
    {
        return $this->total_amount;
    }

    /**
     * Set the value of total_amount
     */
    public function setTotalAmount($total_amount): self
    {
        $this->total_amount = $total_amount;

        return $this;
    }

    /**
     * Get the value of payment_type
     */
    public function getPaymentType()
    {
        return $this->payment_type;
    }

    /**
     * Set the value of payment_type
     */
    public function setPaymentType($payment_type): self
    {
        $this->payment_type = $payment_type;

        return $this;
    }

    /**
     * Get the value of invoice_no
     */
    public function getInvoiceNo()
    {
        return $this->invoice_no;
    }

    /**
     * Set the value of invoice_no
     */
    public function setInvoiceNo($invoice_no): self
    {
        $this->invoice_no = $invoice_no;

        return $this;
    }

    /**
     * Get the value of order_date
     */
    public function getOrderDate()
    {
        return $this->order_date;
    }

    /**
     * Set the value of order_date
     */
    public function setOrderDate($order_date): self
    {
        $this->order_date = $order_date;

        return $this;
    }

    /**
     * Get the value of order_month
     */
    public function getOrderMonth()
    {
        return $this->order_month;
    }

    /**
     * Set the value of order_month
     */
    public function setOrderMonth($order_month): self
    {
        $this->order_month = $order_month;

        return $this;
    }

    /**
     * Get the value of order_year
     */
    public function getOrderYear()
    {
        return $this->order_year;
    }

    /**
     * Set the value of order_year
     */
    public function setOrderYear($order_year): self
    {
        $this->order_year = $order_year;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     */
    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
