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
        $this->yes = new SickBlock();
        $this->no = new PaymentBill();
    }

    public static function checkSicknessStatus()
    {
        return 'yes';
    }
}
