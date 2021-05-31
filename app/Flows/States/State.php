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


    public function getThis()
    {
        return $this;
    }

    public function getArguments()
    {
        return $this->getArguments();
    }

    public function setArguments(array $arguments)
    {
        self::$arguments = $arguments;
    }
}
