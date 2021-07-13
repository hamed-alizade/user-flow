<?php

namespace App\Flows\States;

class CheckVisitStatus extends State
{
    public $type = State::DECISION;
    public $yes;
    public $no;

    public function __construct()
    {
        $this->yes = MenuSelect::class;
    }

    public function checkVisitStatus()
    {
        return self::YES;
    }
}
