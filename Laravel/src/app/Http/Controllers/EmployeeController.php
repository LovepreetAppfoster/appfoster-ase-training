<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function index(){
        $request = Request::create('http://127.0.0.1:8000/api/users', 'GET');
        $response = Route::dispatch($request);
        $content = $response->getContent();
        // return $content;
        $users = json_decode($content, true);
        $data = compact('users');
        return view('employees')->with($data);

        //Testing
        // $response = Http::get('http://127.0.0.1:8000/api/users');
        // return $response->successful();
        // $response = Http::curl('http://127.0.0.1:8000/api/users', 'GET');
    }

    public function showUserDetails($id){
        $url = 'http://127.0.0.1:8000/api/users/';
        $url_id = $url.$id;
        $request = Request::create($url_id, 'GET');
        $response = Route::dispatch($request);
        return $response;
    }

    public function create(){
        return view('registerForm');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $forward_req = Request::create('http://127.0.0.1:8000/api/users', 'POST');
        $forward_req->merge([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $response = Route::dispatch($forward_req);

        $responseContent = $response->getContent();
        return redirect('/users');


        // $responseStatusCode = $response->getStatusCode();
        // echo"$responseContent";
        // echo"$responseStatusCode";
    }

    public function delete($id){
        $url = 'http://127.0.0.1:8000/api/users/';
        $url_id = $url.$id;
        //echo "$url_id";
        $request = Request::create($url_id, 'DELETE');
        $response = Route::dispatch($request);
        return redirect('/users');
    }

    public function edit($id){
        
        $url = 'http://127.0.0.1:8000/api/users/';
        $url_id = $url.$id;
        $request = Request::create($url_id, 'GET');
        $response = Route::dispatch($request);
        $content = $response->getContent();
        $user = json_decode($content, true);
        $name = $user['data']['name'];
        $email = $user['data']['email'];
        $data = compact('id','name', 'email');
        // //session()->forget(['edit_email', 'edit_name']);
        
        return view('updateForm')->with($data);
    }
    public function update(Request $request,$id){
        $url = 'http://127.0.0.1:8000/api/users/';
        $url_id = $url.$id;
        $forward_req = Request::create($url_id, 'PUT');
        $forward_req->merge([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $response = Route::dispatch($forward_req);

        $responseData = json_decode($response->getContent(), true);

        if (isset($responseData['error'])) {
                // If there's an error message from the API, store it in the hidden input field
            $request->merge(['api-error' => $responseData['error']]);
                //print_r($request->all());
                // Redirect back to the form with the error message
                //return redirect()->back()
                //return redirect()->back()->with('error', $responseData['error']);
            return redirect('/users');
        }
    
        //$responseContent = $response->getContent();
        return redirect('/users'); 
    }


    //Projects
    public function showProjects($id){
        $url = 'http://127.0.0.1:8000/api/users/';
        $for_url = $url.$id.'/projects';
        $request = Request::create($for_url, 'GET');
        $response = Route::dispatch($request);
        $content = $response->getContent();
        // return $content;
        $projects = json_decode($content, true);
        $data = compact('projects','id');
        return view('projects')->with($data);
    }

    public function createProjects($id){
        $data = compact('id');
        return view('projectForm')->with($data);
        //return view('projectForm');
    }

    public function storeProjects(Request $request){
        $url = 'http://127.0.0.1:8000/api/users/';
        $id = $request->id;
        $for_url = $url.$id.'/projects';
        $forward_req = Request::create($for_url, 'POST');
        $forward_req->merge([
            'name' => $request->name,
            'emp_id' => $request->id,
        ]);
        $response = Route::dispatch($forward_req);
        
        $redirect_url = '/users/user/projects/'.$id;
        return redirect($redirect_url);
    }

    public function editProjects($id, $project_id, $project_name){
        $data = compact('id', 'project_id', 'project_name');
        return view('updateProjectForm')->with($data);
    }

    public function updateProjects(Request $request, $id, $project_id){
        $url = 'http://127.0.0.1:8000/api/users/';
        $for_url = $url.$id.'/projects'.'/'.$project_id;
        $forward_req = Request::create($for_url, 'PUT');
            $forward_req->merge([
                'name' => $request->name
            ]);
            $response = Route::dispatch($forward_req);

            $redirect_url = '/users/user/projects/'.$id;
            return redirect($redirect_url);
    }

    public function deleteProjects($id, $project_id){
        $url = 'http://127.0.0.1:8000/api/users/';
        $for_url = $url.$id.'/projects'.'/'.$project_id;
        $request = Request::create($for_url, 'DELETE');
        $response = Route::dispatch($request);
        $redirect_url = '/users/user/projects/'.$id;
        return redirect($redirect_url);
    }
}
