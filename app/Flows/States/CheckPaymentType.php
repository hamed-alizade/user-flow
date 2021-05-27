<?php

namespace App\Flows\States;

class CheckPaymentType extends State
{
    public $name = 'checkPaymentType';
    public $type = 'decision';
    public $yes;
    public $no;

    public function __construct()
    {
        $this->yes = new PaymentCard();
        $this->no = new PaymentOnline();
    }
}
