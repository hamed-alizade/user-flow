<?php

namespace App\Flows\States;

class MenuConfirm extends State
{
    public $name = 'menu/confirm';
    public $type = 'inout';
    public $allowedCheckpoints = ['POK', 'NORMAL'];

}
