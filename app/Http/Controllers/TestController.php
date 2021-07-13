<?php

namespace App\Http\Controllers;

use App\Flows\Flow;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $requestedState = $request['x-route'];
        $arguments = $request->all();
        return Flow::getNextState($requestedState, $arguments);
    }

}
