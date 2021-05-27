<?php

namespace App\Flows;

use App\Flows\States\State;
use Illuminate\Support\Facades\DB;

class Flow
{
    protected static $flow = [];
    protected static $arguments = [];

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

        $userCheckpoint = self::getUserCheckpoint($userId, $requestedFlowName);
        if ( ! $userCheckpoint) {
            [$flowName, $statesName] = self::initializeUserCheckPoint($userId);
            //////////////////////////////////
        }

        $requestedStateIndex = self::getIndexOfState($requestedState, self::$flow);
        if ($requestedStateIndex === false) {
            return '';
        }

        if (in_array($userCheckpoint->checkpoint, self::$flow[$requestedStateIndex]->allowedCheckpoints)) {
            $nextState = $requestedState;
        } else {
            return '';
        }

        $nextCheckpoint = self::$flow[$requestedStateIndex]->checkpoint;
        $nextStatePlus1Index = $requestedStateIndex + 1;
        if(empty(self::$flow[$nextStatePlus1Index])) {
            return '';
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
        self::setUserCheckpoint($userId, $flowName,$nextCheckpoint);
        return $nextState;



//        $flowClassName = __NAMESPACE__ .'\\' . $flowName;
//        $flowObj = new $flowClassName;
//        return call_user_func(array($flowObj, 'getNextState'), $userId, $requestedState, $flowName, $arguments);

    }

    public static function getIndexOfState(State $state,array $flow)
    {
        $statesName = self::getStatesName($flow);
        return array_search($state->name, $statesName);
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
        DB::table('user_checkpoint')->updateOrCreate(
            ['user_id' => $userId, 'flow_name' => $flowName],
            ['checkpoint' => $checkpoint]
        );
    }

    private static function initializeUserCheckPoint($userId) : array
    {
        // get default checkpoint
        // get default state in default flow

        $defaultCheckpoint = '';
        $defaultFlow = AbstractFlow::getDefaultFlow();
        $defaultState = $defaultFlow::flow[0];

        self::setUserCheckpoint($userId, $defaultFlow::name, $defaultCheckpoint);


        // for example:
        return [$defaultFlow, $defaultState];
    }
}
