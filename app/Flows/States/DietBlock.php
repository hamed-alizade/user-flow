<?php

namespace App\Flows\States;

class DietBlock extends State
{
    public $type = State::DISPLAY;
    public $checkpoint = 'DBLOCKED';
    public $allowedCheckpoints = ['REG', 'NORMAL'];
    public $next = DietType::class;

}
