<?php

namespace App\Flows\States;

class Report extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['REG'];

}
