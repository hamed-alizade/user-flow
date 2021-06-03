<?php

namespace App\Flows\States;

class Package extends State
{
    public $name = 'package';
    public $type = 'inout';
    public $allowedCheckpoints = ['REG', 'BLOCKED', 'DBLOCKED'];

}
