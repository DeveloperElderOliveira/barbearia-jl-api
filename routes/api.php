<?php
namespace App\Http\Controllers;

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



Route::group(['middleware' => 'api'], function($router){
    
    Route::get('/', function () {
        return response()->json(['message'=>'Api barbearia JL','status' => 'Connected']);
    });
    
    Route::resource('schedules',SchedulesController::class)->except('create','edit');
    Route::get('loadHorarios/{dia}',[SchedulesController::class,'loadHorarios']);
    Route::post('confirmarAgendamento',[SchedulesController::class,'confirmarAgendamento']);
    Route::post('cancelarAgendamento',[SchedulesController::class,'cancelarAgendamento']);
    
    //Auth
    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
    
    Route::resource('companies',CompaniesController::class)->except('create','edit');
    

});
