<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    function submit(Request $req)
    {
        $response = ['message' => 'Data has been submitted successfully!'];
//        $response = ['error' => 'Data has not been submitted successfully!'];
        return response()->json($response, 200);
    }
}
