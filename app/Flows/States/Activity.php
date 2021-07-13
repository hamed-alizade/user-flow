<?php

namespace App\Flows\States;

class Activity extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['POK'];

}
