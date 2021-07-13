<?php

namespace App\Flows\States;

class PaymentBill extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['REG'];

}
