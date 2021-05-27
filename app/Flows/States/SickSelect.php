<?php

namespace App\Flows\States;

class SickSelect extends State
{
    public $name = 'sick/select';
    public $type = 'inout';
    public $allowedCheckpoints = ['REG'];

}
