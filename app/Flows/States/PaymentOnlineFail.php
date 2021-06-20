<?php

namespace App\Flows\States;

class PaymentOnlineFail extends State
{
    public $name = 'payment/online/fail';
    public $type = 'inout';
    public $checkpoint = 'PFAIL';
    public $allowedCheckpoints = ['REG'];
    public $next = PaymentBill::class;
}
