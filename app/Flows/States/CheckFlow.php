<?php

namespace App\Flows\States;

use App\Flows\States;

class CheckFlow extends State
{
    public $type = State::DECISION;

    public function checkFlow()
    {
        // $example = self::$arguments['product_count'];
        // if($product_count > 0) {
        //     return View::class;
        // }
        // return Alert::class;
    }
}
