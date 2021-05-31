<?php

namespace App\Flows\States;

class WeightEnter extends State
{
    public $name = 'weight/enter';
    public $type = 'inout';
    public $allowedCheckpoints = ['NORMAL'];

}
