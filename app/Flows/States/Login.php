<?php

namespace App\Flows\States;


use App\Flows\States\CheckFlow;

class Login extends State
{
    public $type = State::DISPLAY;
    // public $allowedCheckpoints = ['REG'];
    public $next = CheckFlow::class;
}
