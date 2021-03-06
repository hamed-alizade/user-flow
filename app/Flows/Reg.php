<?php

namespace App\Flows;

use App\Flows\States\Activity;
use App\Flows\States\CheckDietPermission;
use App\Flows\States\CheckSicknessStatus;
use App\Flows\States\DietBlock;
use App\Flows\States\DietType;
use App\Flows\States\End;
use App\Flows\States\MenuConfirm;
use App\Flows\States\MenuSelect;
use App\Flows\States\Package;
use App\Flows\States\PaymentBill;
use App\Flows\States\PaymentCardConfirm;
use App\Flows\States\PaymentCardReject;
use App\Flows\States\PaymentCardWait;
use App\Flows\States\PaymentEndPointAction;
use App\Flows\States\Report;
use App\Flows\States\SickBlock;
use App\Flows\States\SickSelect;
use App\Flows\States\SickSelectAction;
use App\Flows\States\Size;
use App\Flows\States\Start;
use App\Flows\States\StartListFlowAction;
use App\Flows\States\TestAction;
use App\Flows\States\View;

class Reg extends AbstractFlow
{
    protected $isMain = true;
    protected $isDependent = false;

    public function __construct()
    {
        $this->flow = [
            Start::class,
            DietType::class,
            Size::class,
            Report::class,
            SickSelect::class,
//            SickSelectProcess::class,
            Package::class,
            CheckDietPermission::class,
            DietBlock::class,
            CheckSicknessStatus::class,
            SickBlock::class,
            Activity::class,
            TestAction::class,
//            DietHistory::class,
//            DietGoal::class,
//            Overview::class,
//            CheckCountry::class,
//            Messenger::class,
//            CheckHavingPhysicalPackage::class,
//            Postal::class,
            MenuSelect::class,
            MenuConfirm::class,
            StartListFlowAction::class,
            End::class
        ];

        $this->addAccessory(Payment::class, SickBlock::class);

        $this->checkpoints = [
            'REG'   => ['description' => 'ثبت نام ناقص' , 'next' => DietType::class],
            'PWAIT' => ['description' => 'در انتظار تایید پرداخت' , 'next' => PaymentCardWait::class],
            'POK'   => ['description' => 'پرداخت موفق (ترم تشکیل شده اما ویزیت فعال ندارد)' , 'next' => Activity::class],
            'PFAIL' => ['description' => 'پرداخت ناموفق' , 'next' => PaymentCardReject::class],
//            'ETERM' => ['description' => 'ترم منقضی شده' , 'next' => 'checkTermStatus'],  // should be checked if it need to be renewed or revived
//            'EVISIT' => ['description' => 'ویزیت منقضی شده' , 'next' => 'getWeightAlert'],
//            'EMENU' => ['description' => 'لیست غذایی ندارد' , 'next' => 'getMenuAlert'],
//            'EFOOD' => ['description' => 'لیست غذایی خالی است' , 'next' => 'getFood'],
//            'NORMAL' => ['description' => 'وضعیت نرمال' , 'next' => View::class],
            'BLOCKED'  => ['description' => 'ممانعت از رژیم به علت بیماری' , 'next' => SickBlock::class],
            'DBLOCKED' => ['description' => 'ممانعت از رژیم' , 'next' => DietBlock::class],
            'SPAY'     => ['description' => 'شروع پرداخت', 'next' => PaymentBill::class],
        ];
    }
}
