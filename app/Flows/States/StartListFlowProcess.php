<?php

namespace App\Flows\States;

use App\Flows\Flow;
use App\Flows\ListFlow;

class StartListFlowProcess extends State
{
    public $name = 'startListFlowProcess';
    public $type = 'process';


    public function startListFlowProcess()
    {
        if (self::$arguments['menu_id'])
        {
            Flow::jumpTo(ListFlow::class);
        }
    }
}
