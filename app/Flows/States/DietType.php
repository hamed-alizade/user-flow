<?php

namespace App\Flows\States;

class DietType extends State
{
    public $type = State::DISPLAY;
    public $checkpoint = 'REG';
    public $allowedCheckpoints = ['REG', 'DBLOCKED'];

}
