<?php

namespace App\Flows\States;

class SickBlock extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['REG', 'NORMAL', 'BLOCKED', 'DBLOCKED'];
    public $next = SickSelect::class;

}
