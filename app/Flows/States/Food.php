<?php

namespace App\Flows\States;

class Food extends State
{
    public $name = 'food';
    public $type = 'inout';
    public $allowedCheckpoints = ['NORMAL'];

}
