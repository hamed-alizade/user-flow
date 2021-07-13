<?php

namespace App\Flows\States;

class PaymentOnline extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['REG'];

}
