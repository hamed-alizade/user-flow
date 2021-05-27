<?php

namespace App\Flows\States;

class Report extends State
{
    public $name = 'report';
    public $type = 'inout';
    public $allowedCheckpoints = ['REG'];

}
