<?php

namespace App\Flows\States;

class SickBlock extends State
{
    public $name = 'sick/block';
    public $type = 'inout';
    public $checkpoint = 'BLOCKED';
    public $allowedCheckpoints = ['REG'];

}
