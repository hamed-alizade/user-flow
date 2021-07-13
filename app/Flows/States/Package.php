<?php

namespace App\Flows\States;

class Package extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['REG', 'BLOCKED', 'DBLOCKED'];

}
