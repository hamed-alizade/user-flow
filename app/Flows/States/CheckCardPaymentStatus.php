<?php

namespace App\Flows\States;

class CheckCardPaymentStatus extends State
{
    public $name = 'checkCardPaymentStatus';
    public $type = 'decision';
    public $yes;
    public $no;

    public function __construct()
    {
        $this->yes = new PaymentCardConfirm();
        $this->no = new PaymentCardReject();
    }
}
