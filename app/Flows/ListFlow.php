<?php

namespace App\Flows;

use App\Flows\States\Activity;
use App\Flows\States\CheckDietPermission;
use App\Flows\States\CheckMenuType;
use App\Flows\States\CheckSicknessStatus;
use App\Flows\States\CheckVisitStatus;
use App\Flows\States\DietBlock;
use App\Flows\States\DietType;
use App\Flows\States\End;
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
    protected $isMain = true;
    protected $isDependent = false;

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
//            SickBlock::class,    // اگر این مورد نباشه اجرای برنامه از حلقه خارج نمیشه (تا اینکه به یه استیت غیرتابع برسه اگه هم نباشه ...)
            End::class
        ];

        $this->checkpoints = [
//            'REG'   => ['description' => 'ثبت نام ناقص' , 'next' => DietType::class],
//            'PWAIT' => ['description' => 'در انتظار تایید پرداخت' , 'next' => PaymentCardWait::class],
            'POK'   => ['description' => 'پرداخت موفق (ترم تشکیل شده اما ویزیت فعال ندارد)' , 'next' => View::class],
//            'PFAIL' => ['description' => 'پرداخت ناموفق' , 'next' => PaymentCardReject::class],
            'ETERM' => ['description' => 'ترم منقضی شده' , 'next' => 'checkTermStatus'],  // should be checked if it need to be renewed or revived
            'EVISIT' => ['description' => 'ویزیت منقضی شده' , 'next' => 'getWeightAlert'],
            'EMENU' => ['description' => 'لیست غذایی ندارد' , 'next' => 'getMenuAlert'],
            'EFOOD' => ['description' => 'لیست غذایی خالی است' , 'next' => 'getFood'],
            'NORMAL' => ['description' => 'وضعیت نرمال' , 'next' => View::class],
            'BLOCKED'  => ['description' => 'ممانعت از رژیم به علت بیماری' , 'next' => SickBlock::class],
            'DBLOCKED' => ['description' => 'ممانعت از رژیم' , 'next' => DietBlock::class],
//            'SPAY'     => ['description' => 'شروع پرداخت', 'next' => PaymentBill::class],
        ];
    }
}
