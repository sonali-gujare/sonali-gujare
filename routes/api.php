<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;

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
// Route::resource('todo', TodoController::class);
// Route::post('login', [LoginController::class,'login']);
// Route::group(['middleware'=>['auth:sanctum']], function () {
//     Route::apiResource('task', TaskController::class);  
// });

Route::group([
    'middleware' => 'api', 'namespaces' => 'App\Http\Controllers'
], function($router){
Route::post('login', [AuthController::class,'login']);

    Route::apiResource('task', TaskController::class);
});
