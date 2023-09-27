<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function example(Request $request)
    {
        return response()->json(['message' => 'API call successful']);
    }
}
