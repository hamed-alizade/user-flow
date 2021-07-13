<?php

namespace App\Flows\States;

class Size extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['REG', 'DBLOCKED'];

}
