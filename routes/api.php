<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\AppointmentsController;
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

Route::middleware('auth:sanctum')->get('/appointments/patient', [AppointmentsController::class, 'patientIndex']);

Route::middleware('auth:sanctum')->get('/appointments/doctor', [AppointmentsController::class, 'doctorIndex']);

Route::middleware('auth:sanctum')->post('/appointments', [AppointmentsController::class, 'store']);

Route::middleware('auth:sanctum')->patch('/appointments/{appointment}', [AppointmentsController::class, 'update']);

Route::middleware('auth:sanctum')->delete('/appointments/{appointment}', [AppointmentsController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/symptoms', [SymptomController::class, 'index']);
