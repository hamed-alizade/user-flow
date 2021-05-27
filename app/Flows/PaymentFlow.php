<?php

namespace App\Flows;

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

class PaymentFlow extends AbstractFlow
{
    protected $name = 'PaymentFlow';

    public function __construct()
    {
        $this->flow = [
            new PaymentCard(),
            new PaymentCardWait(),
            new CheckCardPaymentStatus(),
            new PaymentCardConfirm(),
            new PaymentCardReject(),
            new PaymentOnlineSuccess(),
            new PaymentOnlineFail(),
        ];
    }
}
