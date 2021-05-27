<?php

namespace App\Http\Controllers;

use App\Flows\Flow;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $userId=794510;
        $requestedState = $request['x-route'];
        $arguments = ['user_id' => $userId, 'diet_type_id' => 2];
        return Flow::getNextState($userId, $requestedState, $arguments);
    }

}
