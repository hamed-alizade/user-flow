<?php

namespace App\Flows\States;

class PaymentCardConfirm extends State
{
    public $name = 'payment/card/confirm';
    public $type = 'inout';
    public $checkpoint = 'POK';
    public $allowedCheckpoints = ['PWAIT'];
    public $next = PaymentEndPointProcess::class;
}
