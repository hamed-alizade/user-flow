<?php

namespace App\Flows\States;

class CheckCardPaymentStatus extends State
{
    public $type = State::DECISION;
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
