<?php

namespace App\Flows\States;

class PaymentOnlineSuccess extends State
{
    public $type = State::DISPLAY;
    public $checkpoint = 'POK';
    public $allowedCheckpoints = ['REG'];
    public $next = PaymentEndPointAction::class;
}
