<?php

namespace App\Flows\States;

class SickSelect extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['REG','BLOCKED', 'NORMAL'];

}
