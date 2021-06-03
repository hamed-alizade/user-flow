<?php

namespace App\Flows;

use App\Flows\States\Activity;
use App\Flows\States\CheckDietPermission;
use App\Flows\States\CheckSicknessStatus;
use App\Flows\States\DietBlock;
use App\Flows\States\DietType;
use App\Flows\States\Package;
use App\Flows\States\Report;
use App\Flows\States\SickBlock;
use App\Flows\States\SickSelect;
use App\Flows\States\SickSelectProcess;
use App\Flows\States\Size;
use App\Flows\States\Start;
use App\Flows\States\StartListFlowProcess;

class PsychologyFlow extends AbstractFlow
{
    protected $isMain = false;
    protected $isDependent = false;

    public function __construct()
    {
        $this->flow = [
            Start::class,
            Size::class,
            SickSelect::class,
            Package::class,
            Activity::class,
        ];
    }
}
