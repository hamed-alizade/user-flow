<?php

namespace App\Flows\States;

class MenuSelect extends State
{
    public $name = 'menu/select';
    public $type = 'inout';
    public $allowedCheckpoints = ['NORMAL'];

}
