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

class RegFlow extends AbstractFlow
{
    protected $name = 'RegFlow';
    protected $isMain = true;

    public function __construct()
    {
        $this->flow = [
            DietType::class,
            Size::class,
            Report::class,
            SickSelect::class,
            SickSelectProcess::class,
            Package::class,
            CheckDietPermission::class,
            CheckSicknessStatus::class,
            DietBlock::class,
            SickBlock::class,

            Activity::class,
//            DietHistory::class,
//            DietGoal::class,
//            Overview::class,
//            CheckCountry::class,
//            Messenger::class,
//            CheckHavingPhysicalPackage::class,
//            Postal::class,
//            MenuSelect::class,
//            MenuConfirm::class,
//            StartFoodListProcess::class,
        ];

        $this->addAccessory(PaymentFlow::class, SickBlock::class);
    }
}
