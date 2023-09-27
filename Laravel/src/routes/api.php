<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Books\BooksController;
use App\Http\Controllers\Api\ApiEmployeeController;
use App\Http\Controllers\ExampleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth.basic')->group(function () {
    Route::apiResource('books', BooksController::class);
});

Route::get('/', function () {
    return response()->json([
        'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
    ]);
});

// Employee API Route
Route::apiResource('users', ApiEmployeeController::class);

//Project API Routes
Route::get('/users/{id}/projects', [ApiEmployeeController::class, 'showProjects']);
Route::delete('/users/{id}/projects/{proid}', [ApiEmployeeController::class, 'deleteProject']);
Route::post('/users/{id}/projects', [ApiEmployeeController::class, 'createProject']);
Route::put('/users/{id}/projects/{prodid}', [ApiEmployeeController::class, 'updateProject']);

Route::prefix('api')->group(function () {
    Route::post('example', 'ExampleController@example');
});


// Route::get('/view', function(){
//     return view('welcome');
// });