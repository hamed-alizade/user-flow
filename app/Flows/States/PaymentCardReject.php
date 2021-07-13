<?php

namespace App\Flows\States;

class PaymentCardReject extends State
{
    public $type = State::DISPLAY;
    public $checkpoint = 'PFAIL';
    public $allowedCheckpoints = ['PWAIT'];
    public $next = PaymentBill::class;
}
