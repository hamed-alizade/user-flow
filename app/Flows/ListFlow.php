<?php

namespace App\Flows;

use App\Flows\States\Activity;
use App\Flows\States\CheckDietPermission;
use App\Flows\States\CheckMenuType;
use App\Flows\States\CheckSicknessStatus;
use App\Flows\States\CheckVisitStatus;
use App\Flows\States\DietBlock;
use App\Flows\States\DietType;
use App\Flows\States\Food;
use App\Flows\States\MenuAlert;
use App\Flows\States\MenuSelect;
use App\Flows\States\Package;
use App\Flows\States\Report;
use App\Flows\States\SickBlock;
use App\Flows\States\SickSelect;
use App\Flows\States\SickSelectProcess;
use App\Flows\States\Size;
use App\Flows\States\StartFoodListProcess;
use App\Flows\States\View;
use App\Flows\States\WeightAlert;
use App\Flows\States\WeightEnter;

class ListFlow extends AbstractFlow
{
    protected $name = 'ListFlow';
    protected $isMain = true;

    public function __construct()
    {
        $this->flow = [
            CheckVisitStatus::class,
            View::class,
            CheckVisitStatus::class,
            MenuAlert::class,
            MenuSelect::class,
            CheckMenuType::class,
            Food::class,
            CheckVisitStatus::class,
            WeightAlert::class,
            WeightEnter::class,
            SickSelect::class,
            CheckDietPermission::class,
            CheckSicknessStatus::class,
            StartFoodListProcess::class,
            DietBlock::class,
            SickBlock::class,
            CheckSicknessStatus::class,
        ];

    }
}
