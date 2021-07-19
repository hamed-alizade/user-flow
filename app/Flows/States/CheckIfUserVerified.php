<?php

namespace App\Flows\States;

use App\Flows\States;

class CheckIfUserVerified extends State
{
    public $type = State::DECISION;

    public function checkIfUserVerified()
    {
        if (empty(self::$arguments['if_user_verified']['data']) or self::$arguments['if_user_verified']['data']['verified'] === false) {
            return Verify::class;
        }
        return Register::class;
    }
}
