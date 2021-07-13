<?php

namespace App\Flows\States;

class MenuAlert extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['NORMAL'];

}
