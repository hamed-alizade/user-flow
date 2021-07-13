<?php

namespace App\Flows\States;

class PaymentCard extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['REG'];

}
