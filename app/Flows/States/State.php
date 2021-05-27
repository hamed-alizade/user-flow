<?php

namespace App\Flows\States;

abstract class State
{
    public $name;
    public $type;

    public $allowedCheckpoints;
    public $checkpoint;
    public $alias;

    public $yes;
    public $no;
    public static $arguments;


}
