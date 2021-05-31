<?php

namespace App\Flows\States;

class CheckSicknessStatus extends State
{
    public $name = 'checkSicknessStatus';
    public $type = 'decision';
    public $yes;
    public $no;

    public function __construct()
    {
        $this->yes = SickBlock::class;
        $this->no = PaymentBill::class;
    }

    public function checkSicknessStatus()
    {
        return 'yes';
//        return 'no';
    }
}
