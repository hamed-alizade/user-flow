<?php

namespace App\Flows\States;

class PaymentOnline extends State
{
    public $name = 'payment/Online';
    public $type = 'inout';
    public $allowedCheckpoints = ['REG'];

}
