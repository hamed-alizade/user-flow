<?php

namespace App\Flows\States;

class PaymentCard extends State
{
    public $name = 'payment/card';
    public $type = 'inout';
    public $allowedCheckpoints = ['REG'];

}
