<?php

namespace App\Flows\States;

use App\Flows\AbstractFlow;
use App\Flows\Flow;

abstract class State
{
    public $name;
    public $type;

    public $allowedCheckpoints;
    protected $checkpoint;

    public $yes;
    public $no;
    const YES = 'yes';
    const NO = 'no';
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

    public function getCheckpoint()
    {
        return $this->checkpoint;
    }

    public function setCheckpoint(string $checkpoint)
    {
        $this->checkpoint = $checkpoint;
    }

}
