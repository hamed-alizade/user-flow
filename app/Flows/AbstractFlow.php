<?php

namespace App\Flows;



use Illuminate\Support\Facades\DB;


abstract class AbstractFlow
{
    protected $flow;
    protected $isMain;
    protected static $arguments;
    protected $checkpoints;


    public function getThis()
    {
        return $this;
    }

    public function getFlow()
    {
        return $this->flow;
    }

    public function getCheckpoints()
    {
        return $this->checkpoints;
    }

    public function getIsMain()
    {
        return $this->isMain;
    }

    public function addAccessory(string $accessory, string $after = null)
    {
        $accessoryFlow = BaseFlow::callMethod($accessory , 'getFlow');

        if( ! $after) {
            $this->flow = array_merge($this->flow, $accessoryFlow);
        }
        else {
            foreach ($accessoryFlow as $state) {
                $afterIndex = Flow::getIndexOfState($after, $this->flow);
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
