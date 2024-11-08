<?php

use App\Http\Controllers\GroupsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register',[RegisterController::class,'register']);
Route::post('login',[RegisterController::class,'login']);
Route::post('resend',[RegisterController::class,'resend']);

Route::middleware('auth.jwt')->group(function ()
{
    Route::post('verification', [RegisterController::class, 'verification']);
    Route::get('getuser',[RegisterController::class,'getUser']);

    Route::post('createGroup',[GroupsController::class,'createGroup']);
    Route::get('getgroups',[GroupsController::class,'getGroups']);
});

Route::middleware('auth.jwt')->get('/user', function (Request $request) 
{
    return $request->user();
});
