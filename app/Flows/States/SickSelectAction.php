<?php

namespace App\Flows\States;

use App\Flows\Flow;

class SickSelectAction extends State
{
    public $type = State::ACTION;

    public function sickSelectAction()
    {
        if (self::$arguments['sick_id'] != 1)
        {
            self::$arguments['test'] = 'test';
            $this->checkpoint = Flow::getUserPreviousCheckpoint();
        }
    }
}
