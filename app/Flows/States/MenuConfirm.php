<?php

namespace App\Flows\States;

class MenuConfirm extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['POK', 'NORMAL'];

}
