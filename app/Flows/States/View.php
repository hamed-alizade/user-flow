<?php

namespace App\Flows\States;

class View extends State
{
    public $type = State::DISPLAY;
    public $allowedCheckpoints = ['POK', 'NORMAL'];
    public $checkpoint = 'NORMAL';

}
