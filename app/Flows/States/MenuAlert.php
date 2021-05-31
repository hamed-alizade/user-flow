<?php

namespace App\Flows\States;

class MenuAlert extends State
{
    public $name = 'menu/alert';
    public $type = 'inout';
    public $allowedCheckpoints = ['NORMAL'];

}
