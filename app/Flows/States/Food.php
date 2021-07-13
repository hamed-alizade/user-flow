<?php

namespace App\Flows\States;

class Food extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['NORMAL'];

}
