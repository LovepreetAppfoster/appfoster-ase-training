<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getUsers(){
        $client = new Client(); //GuzzleHttp\Client
        $url = "http://127.0.0.1:8000/api/users";
        // $theUrl     = config('app.guzzle_test_url').'/api/users/';
        // $users   = Http ::get($theUrl);
        // return $users;
        //return view('employees')->with($users);
     }

     public function session(){
        $sesseion = session()->all();
        print_r($sesseion);
     }
}
