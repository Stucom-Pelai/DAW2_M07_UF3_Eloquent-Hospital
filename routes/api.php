<?php

use App\Http\Controllers\DoctorsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\BirthReportsController;
use App\Http\Controllers\BillsController; 
use App\Http\Controllers\InfrastructureController; 

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('patients', [PatientsController::class, 'getAllPatients'])->name('getAllPatients');
Route::get('rooms/available', [RoomsController::class, 'getAvailableRooms'])->name('getAvailableRooms');
Route::get('medicines', [MedicinesController::class, 'getAllMedicines'])->name('getAllMedicines');
Route::post('medicines', [MedicinesController::class, 'addMedicine'])->name('addMedicine');
Route::get('doctors', [DoctorsController::class, 'getAllDoctors'])->name('getAllDoctors');
Route::get('birth-reports/stats', [BirthReportsController::class, 'getBirthStats'])->name('getBirthStats');
Route::put('bills/{patient_id}/status', [BillsController::class, 'payBill']);

Route::get('/soap/wsdl', [InfrastructureController::class, 'wsdlAction'])->name('soap-wsdl');
Route::post('/soap/server', [InfrastructureController::class, 'serverAction'])->name('soap-server');
Route::post('/soap/infrastucture-service', [InfrastructureController::class, 'handleRequest'])->name('handleRequest');
