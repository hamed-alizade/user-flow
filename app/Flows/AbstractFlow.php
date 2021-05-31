<?php

namespace App\Flows;



use phpDocumentor\Reflection\Types\Mixed_;

abstract class AbstractFlow
{
    protected $name;
    protected $flow;
    protected static $arguments;

    public function getFlow()
    {
        return $this->flow;
    }

    public function addAccessory(string $accessory, string $after = null)
    {
        $accessoryFlow = self::callMethod($accessory , 'getFlow');

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

    public static function callMethod(string $pathAndClassName, string $functionName, bool $statically = false)
    {
        if ( ! $statically) {
            $obj = new $pathAndClassName;
        }
        return call_user_func(array($obj ?? $pathAndClassName, $functionName));
    }
}
