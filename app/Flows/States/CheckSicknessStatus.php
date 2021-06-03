<?php

namespace App\Flows\States;

use App\Flows\Flow;

class CheckSicknessStatus extends State
{
    public $name = 'checkSicknessStatus';
    public $type = 'decision';
    public $checkpoint;
    public $yes;
    public $no;

    public function __construct()
    {
        $this->yes = SickBlock::class;
    }

    public function checkSicknessStatus()
    {
        if (in_array(self::$arguments['sick_id'], [1,2])) { // 1,2 is prohibited sick_id
            return self::YES;
        } else {
            if (Flow::getCheckpoint() == 'BLOCKED') {
                $this->checkpoint = Flow::getPreviousCheckpoint();
            }
        }
    }
}
