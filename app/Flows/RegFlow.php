<?php

namespace App\Flows;

use App\Flows\States\Activity;
use App\Flows\States\CheckCardPaymentStatus;
use App\Flows\States\CheckDietPermission;
use App\Flows\States\CheckPaymentType;
use App\Flows\States\CheckSicknessStatus;
use App\Flows\States\DietBlock;
use App\Flows\States\DietType;
use App\Flows\States\Package;
use App\Flows\States\PaymentBill;
use App\Flows\States\PaymentCard;
use App\Flows\States\PaymentCardConfirm;
use App\Flows\States\PaymentCardReject;
use App\Flows\States\PaymentCardWait;
use App\Flows\States\PaymentOnlineFail;
use App\Flows\States\PaymentOnlineSuccess;
use App\Flows\States\Report;
use App\Flows\States\SickBlock;
use App\Flows\States\SickSelect;
use App\Flows\States\Size;

class RegFlow extends AbstractFlow
{
    protected $name = 'RegFlow';

    public function __construct()
    {
        self::$defaultFlow = $this;

        $this->flow = [
            new DietType(),
            new Size(),
            new Report(),
            new SickSelect(),
            new Package(),
            new CheckDietPermission(),
            new CheckSicknessStatus(),
            new DietBlock(),
            new SickBlock(),

            new Activity(),
//            new DietHistory(),
//            new DietGoal(),
//            new Overview(),
//            new CheckCountry(),
//            new Messenger(),
//            new CheckHavingPhysicalPackage(),
//            new Postal(),
//            new MenuSelect(),
//            new MenuConfirm(),
//            new StartFoodListProcess(),
        ];

        $this->addAccessory(new PaymentFlow(), new SickBlock());
    }
}
