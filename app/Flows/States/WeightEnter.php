<?php

namespace App\Flows\States;

use App\Flows\Flow;

class WeightEnter extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['NORMAL'];

}
