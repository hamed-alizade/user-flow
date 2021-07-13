<?php

namespace App\Flows;


class Flow extends BaseFlow
{
    protected static $defaultFlow = Reg::class;
    protected static $defaultCheckpoint = 'REG';

}
