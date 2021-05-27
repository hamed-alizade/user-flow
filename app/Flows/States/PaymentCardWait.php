<?php

namespace App\Flows\States;

class PaymentCardWait extends State
{
    public $name = 'payment/card/wait';
    public $type = 'inout';
    public $checkpoint = 'PWAIT';
    public $allowedCheckpoints = ['REG'];

}
