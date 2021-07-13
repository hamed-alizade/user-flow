<?php

namespace App\Flows\States;

class PaymentOnlineFail extends State
{
    public $type = State::DISPLAY;
    public $checkpoint = 'PFAIL';
    public $allowedCheckpoints = ['REG'];
    public $next = PaymentBill::class;
}
