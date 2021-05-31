<?php

namespace App\Flows\States;

class CheckDietPermission extends State
{
    public $name = 'checkDietPermission';
    public $type = 'decision';
    public $yes;
    public $no;

    public function __construct()
    {
        $this->yes = DietBlock::class;
        $this->no = CheckSicknessStatus::class;
    }

    public function checkDietPermission()
    {
        if (self::$arguments['diet_type_id'] == 1)
            return 'yes';
        else
            return 'no';
    }
}
