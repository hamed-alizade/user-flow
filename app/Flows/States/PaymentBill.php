<?php

namespace App\Flows\States;

class PaymentBill extends State
{
    public $name = 'payment/bill';
    public $type = 'inout';
    public $allowedCheckpoints = ['REG'];

}
