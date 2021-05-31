<?php

namespace App\Flows\States;

class CheckVisitStatus extends State
{
    public $name = 'checkVisitStatus';
    public $type = 'decision';
    public $yes;
    public $no;

    public function __construct()
    {
        $this->yes = MenuSelect::class;
        $this->no = MenuAlert::class;
    }
}
