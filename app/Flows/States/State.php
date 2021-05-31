<?php

namespace App\Flows\States;

use App\Flows\AbstractFlow;

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
    public static $currentFlowClassName;
    public static $userId;

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

    public static function getUserPreviousCheckpoint() : ? string
    {
        return AbstractFlow::getUserPreviousCheckpoint(self::$userId, self::$currentFlowClassName);
    }
}
