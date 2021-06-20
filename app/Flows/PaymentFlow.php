<?php

namespace App\Flows;

use App\Flows\States\CheckCardPaymentStatus;
use App\Flows\States\CheckPaymentType;
use App\Flows\States\PaymentEndPointProcess;
use App\Flows\States\PaymentBill;
use App\Flows\States\PaymentCard;
use App\Flows\States\PaymentCardConfirm;
use App\Flows\States\PaymentCardReject;
use App\Flows\States\PaymentCardWait;
use App\Flows\States\PaymentOnline;
use App\Flows\States\PaymentOnlineFail;
use App\Flows\States\PaymentOnlineSuccess;

class PaymentFlow extends AbstractFlow
{
    protected $isMain = false;
    protected $isDependent = true;

    public function __construct()
    {
        $this->flow = [
            PaymentBill::class,
            CheckPaymentType::class,

            PaymentCard::class,
            PaymentCardWait::class,
            CheckCardPaymentStatus::class,
            PaymentCardConfirm::class,
            PaymentCardReject::class,

            PaymentOnline::class,
            PaymentOnlineSuccess::class,
            PaymentOnlineFail::class,

            PaymentEndPointProcess::class,
        ];
    }
}
