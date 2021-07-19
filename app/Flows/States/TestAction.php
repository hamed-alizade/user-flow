<?php

namespace App\Flows\States;

use App\Flows\Flow;
use App\Flows\FoodList;

class TestAction extends State
{
    public $type = State::ACTION;


    public function __construct()
    {
        $this->yes=MenuSelect::class;
    }

    public function testAction()
    {
        return $this->yes;
    }
}
