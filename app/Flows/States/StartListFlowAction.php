<?php

namespace App\Flows\States;

use App\Flows\Flow;
use App\Flows\FoodList;

class StartListFlowAction extends State
{
    public $type = State::ACTION;


    public function startListFlowAction()
    {
        if (self::$arguments['menu_id'])
        {
            Flow::jumpTo(FoodList::class);
        }
    }
}
