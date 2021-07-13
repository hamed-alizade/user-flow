<?php

namespace App\Flows\States;

class PaymentCardConfirm extends State
{
    public $type = State::DISPLAY;
    public $checkpoint = 'POK';
    public $allowedCheckpoints = ['PWAIT'];
    public $next = PaymentEndPointAction::class;
}
