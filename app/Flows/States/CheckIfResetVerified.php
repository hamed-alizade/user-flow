<?php

namespace App\Flows\States;

use App\Flows\States\PassVerify;

class CheckIfResetVerified extends State
{
    public $type = State::DECISION;

    public function checkIfResetVerified()
    {
        if (empty(self::$arguments['IfResetVerified']['data']) or self::$arguments['IfResetVerified']['data']['verified'] === false) {
            return PassVerify::class;
        }
        return PassReset::class;
    }
}
