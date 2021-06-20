<?php

namespace App\Flows\States;

class CheckCardPaymentStatus extends State
{
    public $name = 'checkCardPaymentStatus';
    public $type = 'decision';
    public $yes;
    public $no;

    public function __construct()
    {
        $this->yes = PaymentCardConfirm::class;
        $this->no = PaymentCardReject::class;
    }

    public function CheckCardPaymentStatus()
    {
        return $this->yes;
    }
}
