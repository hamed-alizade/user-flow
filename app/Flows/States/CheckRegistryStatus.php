<?php

namespace App\Flows\States;

use App\Flows\States;

class CheckRegistryStatus extends State
{
    public $type = State::DECISION;

    public function checkRegistryStatus()
    {
        if (self::$arguments['user_registry_status'] ?? false) {
            return Login::class;
        } elseif (self::$arguments['user_need_validation']) {
            return CheckIfUserVerified::class;
        }
        // TODO: should be edit
        return '';
    }
}
