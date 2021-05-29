<?php

namespace App\Flows;


use App\Flows\States\State;

abstract class AbstractFlow
{
    protected $name;
    protected $flow;
    protected static $arguments;

    public function getFlow()
    {
        return $this->flow;
    }

    public function addAccessory(AbstractFlow $accessory, State $after = null)
    {
        if( ! $after) {
            $this->flow = array_merge($this->flow, $accessory->flow);
        }
        else {
            foreach ($accessory->flow as $state) {
                $afterIndex = Flow::getIndexOfState($after->name, $this->flow);
                $firstSlice = array_slice($this->flow, 0, $afterIndex + 1);
                $secondSlice = array_slice($this->flow, $afterIndex + 1, count($this->flow));
                $this->flow = $firstSlice;
                $this->flow[] = $state;
                $this->flow = array_merge($this->flow, $secondSlice);
                $after = $state;
            }
        }
    }
}
