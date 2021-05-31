<?php

namespace App\Flows;

use App\Flows\States\State;
use Illuminate\Support\Facades\DB;

class BaseFlow
{
    private const INOUT = 'inout';
    private const PROCESS = 'process';
    private const DECISION = 'decision';

    protected static $flow = [];
    protected static $arguments = [];
    protected static $defaultFlow;

    public static function getStatesName(array $states) : array
    {
        return collect($states)->pluck('name')->toArray();
    }

//    public static function getState($userId, $nextState, $arguments) : string
//    {
//
//    }

    public static function getNextState($userId, $currentState, $arguments) : string
    {
        self::$arguments = $arguments;

        [$flowName, $currentStateName] = self::separateFlowAndState(strtolower($currentState));
        $flowClassName = ucfirst(strtolower($flowName)) . 'Flow';
        $flowClass = __NAMESPACE__ . '\\' . $flowClassName;
        $flowObj = new $flowClass;
        $isMain = $flowObj->isMain();
        self::$flow = $flowObj->getFlow();

        if ( ! $isMain) {
            return 'this isn\'t main flow!';
        }

        $userCheckpoint = AbstractFlow::getUserCheckpoint($userId, $flowClassName);
        if( ! empty($userCheckpoint->checkpoint)) {
            $checkpoint = $userCheckpoint->checkpoint;
        } else {
            [self::$flow, $currentStateName, $checkpoint] = self::getDefaultValues();
        }
        $nextPlus1State = null;

        do {
            $currentStateIndex = self::getIndexOfState(__NAMESPACE__ .'\\States\\'.self::toPascalCase($currentStateName), self::$flow);
            if ($currentStateIndex === false) {
                return 'not exist this page!';
                // stop or abort(404)
            }

            $nextStateIndex = $currentStateIndex;
            if( ! empty($userCheckpoint->checkpoint)) { $nextStateIndex = $currentStateIndex + 1; }
            $nextState = AbstractFlow::callMethod(self::$flow[$nextStateIndex],'getThis');
            if($nextPlus1State) {
                $nextState = AbstractFlow::callMethod($nextPlus1State,'getThis');
                $nextPlus1State = null;
            }
            if (empty($nextState)) {
                return 'not exist this page!';
                // stop or abort(404)
            }

            if ($nextState->allowedCheckpoints and ! in_array($checkpoint, $nextState->allowedCheckpoints)) {
                return 'not allowed!';
                // stop or move to a state by checkpoint
            }

            if (in_array(strtolower($nextState->type),[self::DECISION, self::PROCESS])) {
                State::$userId = $userId;
                State::$currentFlowClassName = $flowClassName;
                State::$arguments = self::$arguments;
                $stateClassName = __NAMESPACE__ .'\\States\\'. ucfirst($nextState->name);
                $stateObj = new $stateClassName();
                $result = call_user_func(array($stateObj, $nextState->name));
                self::$arguments = State::$arguments;
                if (strtolower($nextState->type) == self::DECISION) {
                    $nextPlus1State = $nextState->$result ?? null;
                } elseif (strtolower($nextState->type) == self::PROCESS) {
                    $currentStateName = $nextState->name;
                }
                $nextStateCheckpoint = $stateObj->checkpoint ?? $nextState->checkpoint;
            }
            else{
                $nextStateCheckpoint = $nextState->checkpoint;
            }
            $nextStateName = $nextState->name;
            $previousCheckpoint = $checkpoint;
            $checkpoint = $nextStateCheckpoint ?? $checkpoint;
        } while (in_array(strtolower($nextState->type),[self::DECISION, self::PROCESS]));

        if($checkpoint) {
            AbstractFlow::setUserCheckpoint($userId, $flowClassName, $previousCheckpoint, $checkpoint);
        }
        return $flowName . '/' . $nextStateName;
    }

    protected static function toPascalCase($string)
    {
        return str_replace(' ', '', ucwords(str_replace(['-', '/'], ' ', $string)));
    }

    public static function getIndexOfState(string $state,array $flow)
    {
//        $statesName = self::getStatesName($flow);
        return array_search($state, $flow);
    }

    private static function separateFlowAndState($flowAndState) : array
    {
        $slashPosition = strpos($flowAndState,'/');
        $flow = substr($flowAndState, 0, $slashPosition);
        $state = substr($flowAndState, $slashPosition + 1);
        return [$flow, $state];
    }

    private static function getDefaultValues() : array
    {
        $defaultCheckpoint = static::$defaultCheckpoint;
        $defaultFlow = static::$defaultFlow;
        $className = __NAMESPACE__ .'\\'. $defaultFlow;
        $flow = AbstractFlow::callMethod($className, 'getFlow');
        $firstState = AbstractFlow::callMethod($flow[0], 'getThis')->name;
        return [$flow, $firstState, $defaultCheckpoint];
    }

    public static function loadStatesOfFlow(string $flowName) : array
    {
        $flowClassName = __NAMESPACE__ .'\\' . $flowName;
        return AbstractFlow::callMethod($flowClassName, 'getFlow');
    }
}
