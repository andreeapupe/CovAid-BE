<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\UserOwnAppsController;
use App\Http\Controllers\DoctorOwnAppsController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user()->load('role');
});

Route::middleware('auth:sanctum')->get('/doctors', [DoctorsController::class, 'index']);

Route::middleware('auth:sanctum')->get('/patient/appointments', [UserOwnAppsController::class, 'index']);

Route::middleware('auth:sanctum')->get('/doctor/appointments', [DoctorOwnAppsController::class, 'index']);

Route::middleware('auth:sanctum')->get('/symptoms', [SymptomController::class, 'index']);
