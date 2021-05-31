<?php

namespace App\Flows;



use Illuminate\Support\Facades\DB;

abstract class AbstractFlow
{
    protected $name;
    protected $flow;
    protected $isMain;
    protected static $arguments;


    public function getThis()
    {
        return $this;
    }

    public function getFlow()
    {
        return $this->flow;
    }

    public function isMain()
    {
        return $this->isMain;
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

    public static function getUserCheckpoint($userId, $flowName)
    {
        return DB::table('user_checkpoint')->where('user_id', $userId)->where('flow_name', $flowName)->get()->first();
    }

    public static function setUserCheckpoint($userId, $flowName, $previousCheckpoint, $checkpoint)
    {
        DB::table('user_checkpoint')->updateOrInsert(
            ['user_id' => $userId, 'flow_name' => $flowName],
            ['previous_checkpoint' => $previousCheckpoint, 'checkpoint' => $checkpoint]
        );
    }

    public static function getUserPreviousCheckpoint($userId, $flowName) : ? string
    {
        $userCheckpoint = self::getUserCheckpoint($userId, $flowName);
        return $userCheckpoint->previous_checkpoint ?? null;
    }
}
