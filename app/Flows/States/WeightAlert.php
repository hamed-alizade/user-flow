<?php

namespace App\Flows\States;

class WeightAlert extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['NORMAL'];
}
