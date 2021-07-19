<?php

namespace App\Flows\States;

class PaymentEndPointAction extends State
{
    public $type = State::ACTION;

//    public $next = Activity::class;

    public function __construct()
    {
        $this->yes = Activity::class;
    }

    public function paymentEndPointAction()
    {
        return self::YES;
    }
}
