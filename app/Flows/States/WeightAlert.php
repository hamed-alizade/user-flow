<?php

namespace App\Flows\States;

class WeightAlert extends State
{
    public $name = 'weight/alert';
    public $type = 'inout';
    public $allowedCheckpoints = ['NORMAL'];
}
