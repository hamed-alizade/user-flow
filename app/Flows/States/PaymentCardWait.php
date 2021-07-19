<?php

namespace App\Flows\States;

class PaymentCardWait extends State
{
    public $type = State::DISPLAY;
    public $checkpoint = 'PWAIT';
    public $allowedCheckpoints = ['REG', 'PWAIT'];

}
