<?php

namespace App\Flows\States;

use App\Flows\Flow;

class CheckSicknessStatus extends State
{
    public $type = State::DECISION;
    public $yes;
    public $no;

    public function __construct()
    {
        $this->yes = SickBlock::class;
        $this->no = PaymentBill::class;
    }

    public function checkSicknessStatus()
    {
        $prohibitedSickIds = [1, 2];
        if (in_array(self::$arguments['sick_id'], $prohibitedSickIds)) {
            $this->setCheckpoint('BLOCKED');
            return self::YES;
        }

        if (Flow::getCheckpoint() == 'BLOCKED') {
            $this->setCheckpoint(Flow::getPreviousCheckpoint());
        }
        elseif(Flow::getCheckpoint() == 'NORMAL') {
//            $this->no = CheckVisitStatus::class;
            return CheckVisitStatus::class;
        }

        return self::NO;
    }
}
