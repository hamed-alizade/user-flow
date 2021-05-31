<?php

namespace App\Flows\States;

class CheckMenuType extends State
{
    public $name = 'checkMenuType';
    public $type = 'decision';
    public $yes;
    public $no;

    public function __construct()
    {
        $this->yes = Food::class;
        $this->no = MenuAlert::class;
    }
}
