<?php

namespace App\Flows\States;

class MenuSelect extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['POK', 'NORMAL'];

}
