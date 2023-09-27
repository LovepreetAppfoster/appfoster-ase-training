<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;
use App\Models\Employee;
use App\Models\Project;
use Exception;

class IndexController extends Controller
{
    //
    public function index(){
        // $employee = Project::find(1)->employee;
        // return $employee;
        $employees = Employee::with('projects')->get();
        // $project = Employee::all();
        return $employees;
        //return Project::find(3);
        // return "Data";

        //return Employee::find(1)->projects;

        // return Employee::with('projects')->get();
    }

    public function view(){
        $client = new Client(); //GuzzleHttp\Client
        $url = "http://127.0.0.1:8000/api/users";
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $responseBody = json_decode($response->getBody());
        return $responseBody;
        // $request = Request::create('/api/users', 'GET');
        // //print_r($request);
        // //return $request;
        // $response = Route::dispatch($request);
        // $content = $response->getContent();
        // //print_r($content);
        // $data = json_decode($content, true);
        // return $data;
    }

    public function create(){
        try {
            $response = Http::post('http://127.0.0.1:8000/api/users', [
                'name' => 'Steve',
                'email' => 'st@mail.com',
            ]);
            return response()->json(["meg" => "SUccessful"]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function fetchApiData(Request $request)
    {
        // Initialize a cURL session
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/users');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 500); 

        // Execute the cURL request
        $response = curl_exec($ch);

        if ($response === false) {
            // There was an error with the cURL request
            $error = curl_error($ch);
            // Handle the error
            return response()->json(['error' => $error], 500);
        }

        curl_close($ch);
        $apiData = json_decode($response, true);
        return response()->json($apiData);
    }
}
