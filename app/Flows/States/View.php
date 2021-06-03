<?php

namespace App\Flows\States;

class View extends State
{
    public $name = 'view';
    public $type = 'inout';
    public $allowedCheckpoints = ['POK', 'NORMAL'];
    public $checkpoint = 'NORMAL';

}
