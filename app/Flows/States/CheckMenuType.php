<?php

namespace App\Flows\States;

class CheckMenuType extends State
{
    public $type = State::DECISION;
    public $yes;
    public $no;

    public function __construct()
    {
        $this->yes = Food::class;
        $this->no = MenuAlert::class;
    }
}
