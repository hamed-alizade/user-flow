<?php

namespace App\Flows\States;

class PaymentCardReject extends State
{
    public $name = 'payment/card/reject';
    public $type = 'inout';
    public $checkpoint = 'PFAIL';
    public $allowedCheckpoints = ['PWAIT'];

}
