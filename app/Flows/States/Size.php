<?php

namespace App\Flows\States;

class Size extends State
{
    public $name = 'size';
    public $type = 'inout';
    public $allowedCheckpoints = ['REG'];

}
