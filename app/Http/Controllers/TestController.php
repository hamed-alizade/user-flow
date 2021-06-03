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
        $arguments = ['user_id' => $userId, 'diet_type_id' => $request['diet_type_id'], 'sick_id' => $request['sick_id'], 'menu_id' => $request['menu_id']];
        return Flow::getNextState($userId, $requestedState, $arguments);
    }

}
