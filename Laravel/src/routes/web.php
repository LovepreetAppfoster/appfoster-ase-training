<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TestController;

Route::get('/', function(){
    return view('employees');
});

// Route::get('/data', [IndexController::class, 'index']);
// Route::get('/view', [IndexController::class, 'view']);
// Route::put('/create', [IndexController::class, 'create']);

//Employee Routes
Route::get('/users', [EmployeeController::class, 'index']);
Route::get('/users/user/{id}', [EmployeeController::class, 'showUserDetails']);
Route::get('/users/create', [EmployeeController::class, 'create']);
Route::post('/users/store', [EmployeeController::class, 'store']);
Route::get('/users/user/del/{id}', [EmployeeController::class, 'delete']);
Route::get('/users/edit/{id}', [EmployeeController::class, 'edit']);
Route::post('/users/update/{id}', [EmployeeController::class, 'update']);

//Projects Routes
Route::get('/users/user/projects/{id}', [EmployeeController::class, 'showProjects']);
Route::get('/users/user/projects/{id}/create', [EmployeeController::class, 'createProjects']);
Route::post('/users/user/projects/{id}/store', [EmployeeController::class, 'storeProjects']);
Route::get('/users/user/projects/{id}/delete/{project_id}', [EmployeeController::class, 'deleteProjects']);
Route::get('/users/user/projects/{id}/edit/{project_id}', [EmployeeController::class, 'editProjects']);
Route::post('/users/user/projects/{id}/update/{project_id}', [EmployeeController::class, 'updateProjects']);
