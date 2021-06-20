<?php

namespace App\Flows\States;

class PaymentOnlineSuccess extends State
{
    public $name = 'payment/online/success';
    public $type = 'inout';
    public $checkpoint = 'POK';
    public $allowedCheckpoints = ['REG'];
    public $next = PaymentEndPointProcess::class;
}
