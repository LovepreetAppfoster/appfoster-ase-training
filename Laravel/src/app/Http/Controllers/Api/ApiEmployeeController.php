<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class ApiEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emplyopees = Employee::all();
        return response()->json($emplyopees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' =>['required'],
            'email' => ['required', 'email', 'unique:employees,email']
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        else{
            $data = [
                'name' => $request->name,
                'email' => $request->email
            ];
            DB::beginTransaction();
            try{
                Employee::create($data);
                DB::commit();
            } catch(Exception $e){
                Db::rollBack();
                print_r($e->getMessage());
            }
        }
        //print_r($request->all());
        return response()->json([
            "message" => "$request->name added successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        if(is_null($employee)){
            $response = [
                'message' => 'No Employee with such ID',
            ];
        }
        else{
            $response = [
                'data' => $employee,
            ];
        }
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if(!$employee){
            return response()->json([
                "message" => "User not found"
            ]);
        }
        else{
            
            DB::beginTransaction();
            try {
                $newEmail = $request->email;
                // Check if the new email is different from the current email
                if ($newEmail !== $employee->email) {
                    // Check if the new email already exists in the database
                    $existingUserWithEmail = Employee::where('email', $newEmail)->first();
                    if ($existingUserWithEmail) {
                        DB::rollBack();
                        return response()->json([
                            "error" => "Email already exists. Please choose a different email."
                        ]);
                    }
                }

                $employee->update([
                    'name' => $request->name,
                    //'email' => $request->email
                    'email' => $newEmail
                ]);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                $error = $e->getMessage();
                return response()->json([
                    "error" => "$error"
                ]);
            }
            
        }

        return response()->json([
            "message" => "$request->name is updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if(is_null($employee)){
            $response = [
                "message" => "Employee doesn't exists."
            ];
        }
        else{
            DB::beginTransaction();
            try {
                $employee->delete();
                DB::commit();
                $response = [
                    "message" => "Employee deleted successfully."
                ];
            } catch (Exception $e) {
                DB::rollBack();
                print_r($e->getMessage());
            }
        }
        return response()->json($response);
    }

    public function showProjects($id){
        $employeeProjects = Employee::find($id);
        if(!$employeeProjects){
            return response()->json([
                "message" => "user not found"
            ]);
        }
        else{
            try {
                return $employeeProjects->projects;
            } catch (Exception $e) {
                return response()->json($e->getMessage());
            }
        }
    }

    public function createProject(Request $request,$id){
        $employee = Employee::find($id);
        if(!$employee){
            return response()->json([
                "message" => "User not found"
            ]);
        }
        $validator = Validator::make($request->all(),[
            'name' =>['required'],
            //'emp_id' => ['required']
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        else{
            $data = [
                'name' => $request->name,
                'emp_id' => $id
            ];
            DB::beginTransaction();
            try{
                Project::create($data);
                DB::commit();
                return response()->json([
                    "message" => "$request->name added successfully"
                ]);
            } catch(Exception $e){
                Db::rollBack();
                print_r($e->getMessage());
            }
        }
        //print_r($request->all());
        
    }

    public function updateProject(Request $request,$id, $proid){
        $employee = Employee::find($id);
        if(!$employee){
            return response()->json([
                "message" => "User not found"
            ]);
        }
        else{
            $projects=  $employee->projects;
            
            if(sizeof($projects->all()) <= 0){
                return response()->json([
                    "message" => "No project have been alloted"
                ]);
            }
            else{
                $check = false;
                foreach($projects as $project){
                    if($project->project_id == $proid){
                        //$updateProject = $project;
                        $check = true;
                        break;
                    }
                }
                if(!$check){
                    return response()->json([
                        "message" => "This Project has been not been alloated to the user."
                    ]);
                }
                $updateProject = Project::find($proid);
                DB::beginTransaction();
            try {
                $updateProject->update([
                    'name' => $request->name,
                    // 'emp_id' => $request->emp_id
                    'emp-id' => $id
                ]);
                DB::commit();
                return response()->json([
                    "message" => "Project updated successfully"
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                $error = $e->getMessage();
                return response()->json([
                    "error" => "$error"
                ]);
            }
            }
        }
    }

    public function deleteProject($id, $proid){
        $employee = Employee::find($id);
        if(!$employee){
            return response()->json([
                "message" => "User not found"
            ]);
        }
        else{
            $projects=  $employee->projects;
            if(sizeof($projects->all()) <= 0){
                return response()->json([
                    "message" => "No such project have been alloted"
                ]);
            }
            else{
                DB::beginTransaction();
                try {
                    $delProject = Project::find($proid);
                    $delProject->delete();
                    DB::commit();
                    return response()->json([
                        "message" => "Project deleted successfully"
                    ]);

                } catch (Exception $e) {
                    DB::rollBack();
                    $error = $e->getMessage();
                    return response()->json([
                        "error" => "$error"
                    ]);
                }
            }
        }
        // else{
        //     $projects=  $employee->projects;
        //     if(sizeof($projects->all()) <= 0){
        //         return response()->json([
        //             "message" => "No Projects"
        //         ]);
        //     }
        //     else{
        //         foreach($projects as $project){
        //             if($project->project_id == $proid){
        //                 $showProject = $project;
        //                 break;
        //             }
        //         }

        //         return $project;
        //     }
        // }
    }
}
