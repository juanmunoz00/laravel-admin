<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Permission;
use App\Http\Controllers\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Esta ruta tiene una funcion que regresa un texto "hello"

//Route::get('hello', fn() => 'hello');
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    /** Authentication */
    Route::get('user',[AuthController::class, 'user']);
    Route::post('logout',[AuthController::class, 'logout']);

    /** Users CRUD */
    /*
    Route::get('users',[UserController::class, 'index']);
    Route::post('users',[UserController::class, 'store']);
    Route::get('users/{id}',[UserController::class, 'show']);
    Route::put('users/{id}',[UserController::class, 'update']);
    Route::delete('users/{id}',[UserController::class, 'destroy']);
    */

    Route::put('users/info',[UserController::class, 'updateInfo']);
    Route::put('users/password',[UserController::class, 'updatePassword']);

    Route::apiResource('users', UserController::class);
    Route::get('permissions', [PermissionController::class, 'index']);

});
