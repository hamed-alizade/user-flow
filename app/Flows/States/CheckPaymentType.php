<?php

namespace App\Flows\States;

class CheckPaymentType extends State
{
    public $type = State::DECISION;
//    public $yes;
//    public $no;
    public $cartToCart;
    public $online;
    public $couponFully;

    public function __construct()
    {
        $this->cartToCart = PaymentCard::class;
        $this->online = PaymentOnline::class;
        $this->couponFully = PaymentOnlineSuccess::class;
    }

    public function checkPaymentType()
    {
        $paymentTypeId = self::$arguments['payment_type_id'];
        if($paymentTypeId == 1) {
            return 'cartToCart';
        } elseif($paymentTypeId == 2) {
            return 'online';
        } else {
            return 'couponFully';
        }
    }
}
