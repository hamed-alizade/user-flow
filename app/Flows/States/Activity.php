<?php

namespace App\Flows\States;

class Activity extends State
{
    public $name = 'activity';
    public $type = 'inout';
    public $allowedCheckpoints = ['REG'];

}
