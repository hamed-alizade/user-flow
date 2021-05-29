<?php

namespace App\Flows;

use App\Flows\States\State;
use Illuminate\Support\Facades\DB;

class BaseFlow
{
    protected static $flow = [];
    protected static $arguments = [];
    protected static $defaultFlow;

    public static function getStatesName(array $states) : array
    {
        return collect($states)->pluck('name')->toArray();
    }

    public static function getNextState($userId, $requestedState, $arguments) : string
    {
        self::$arguments = $arguments;

        [$requestedFlowName, $requestedState] = self::separateFlowAndState($requestedState);
        $flowName = ucfirst($requestedFlowName) . 'Flow';

        $flowClassName = __NAMESPACE__ .'\\' . $flowName;
        $flowObj = new $flowClassName;
        self::$flow = call_user_func(array($flowObj, 'getFlow'));

        $userCheckpoint = self::getUserCheckpoint($userId, $flowName);
        if ( ! $userCheckpoint) {
            [self::$flow, $requestedState]  = self::getDefaultFlow();
            $requestedState = $requestedState->name;
        }

        $requestedStateIndex = self::getIndexOfState($requestedState, self::$flow);
        if ($requestedStateIndex === false) {
            return 'not exist this page!';
            // stop or abort(404)
        }

        $nextState = $requestedState;
        if ( ! empty($userCheckpoint)) {
            if (in_array($userCheckpoint->checkpoint, self::$flow[$requestedStateIndex]->allowedCheckpoints)) {
                $nextState = $requestedState;
            } else {
                return 'not allowed!';
                // stop or move to somewhere
            }
        }

        $nextCheckpoint = self::$flow[$requestedStateIndex]->checkpoint;
        $nextStatePlus1Index = $requestedStateIndex + 1;
        if(empty(self::$flow[$nextStatePlus1Index])) {
            return 'not exist any state in this flow!';
        }
        $nextStatePlus1 = self::$flow[$nextStatePlus1Index];

        while ($nextStatePlus1->type == 'decision')
        {
            State::$arguments = self::$arguments;
            $result = call_user_func(array(__NAMESPACE__ .'\\States\\'. ucfirst($nextStatePlus1->name), $nextStatePlus1->name));
            if ($result == 'yes') {
                $nextStatePlus1 = $nextStatePlus1->yes;
            } else {
                $nextStatePlus1 = $nextStatePlus1->no;
            }
            $nextCheckpoint = $nextStatePlus1->checkpoint;
            $nextState = $nextStatePlus1->name;
        }
        if($nextCheckpoint) {
            self::setUserCheckpoint($userId, $flowName, $nextCheckpoint);
        }
        return $nextState;
    }

    public static function getIndexOfState(string $state,array $flow)
    {
        $statesName = self::getStatesName($flow);
        return array_search($state, $statesName);
    }

    private static function separateFlowAndState($flowAndState) : array
    {
        $slashPosition = strpos($flowAndState,'/');
        $flow = substr($flowAndState, 0, $slashPosition);
        $state = substr($flowAndState, $slashPosition + 1);
        return [$flow, $state];
    }

    public static function getUserCheckpoint($userId, $flowName)
    {
        return DB::table('user_checkpoint')->where('user_id', $userId)->where('flow_name', $flowName)->get()->first();
    }

    public static function setUserCheckpoint($userId, $flowName, $checkpoint)
    {
        DB::table('user_checkpoint')->updateOrInsert(
            ['user_id' => $userId, 'flow_name' => $flowName],
            ['checkpoint' => $checkpoint]
        );
    }

    private static function getDefaultFlow() : array
    {
        $defaultFlow = static::$defaultFlow;
        $className = __NAMESPACE__ .'\\'. $defaultFlow;
        $defaultFlowObj = new $className;
        $flow = call_user_func(array($defaultFlowObj, 'getFlow'));
        return [$flow, $flow[0]];
    }
}
