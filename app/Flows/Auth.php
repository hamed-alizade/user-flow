<?php

namespace App\Flows;

use App\Flows\States\CheckFlow;
use App\Flows\States\CheckIfResetVerified;
use App\Flows\States\CheckIfUserVerified;
use App\Flows\States\CheckRegistryStatus;
use App\Flows\States\Login;
use App\Flows\States\LoginForget;
use App\Flows\States\PassReset;
use App\Flows\States\PassVerify;
use App\Flows\States\Register;
use App\Flows\States\Verify;

class Auth extends AbstractFlow
{
    protected $isMain = true;
    protected $isDependent = false;

    public function __construct()
    {
        $this->flow = [
//            '/',
            CheckRegistryStatus::class,
            Verify::class,
            CheckIfUserVerified::class,
            Register::class,
            Login::class,
            LoginForget::class,
            PassVerify::class,
            CheckIfResetVerified::class,
            PassReset::class,
            CheckFlow::class,
        ];

        $this->checkpoints = [
            // 'REG'   => ['description' => 'Primary step of register process' , 'next' => Welcome::class],
        ];
    }
}
