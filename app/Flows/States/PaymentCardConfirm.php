<?php

namespace App\Flows\States;

class PaymentCardConfirm extends State
{
    public $type = State::DISPLAY;
    public $checkpoint = 'POK';
    public $allowedCheckpoints = ['PWAIT', 'POK'];
    public $next = PaymentEndPointAction::class;
}
