<?php

use App\Http\Controllers\ProfessionalAvailabilityController;
use App\Http\Controllers\ProfessionalController;
use Illuminate\Support\Facades\Route;

Route::get('/professionals', [ProfessionalController::class, 'index']);
Route::post('/professionals', [ProfessionalController::class, 'store']);
Route::get('/professionals/{id}', [ProfessionalController::class, 'show']);
Route::put('/professionals/{id}', [ProfessionalController::class, 'update']);
Route::delete('/professionals/{id}', [ProfessionalController::class, 'destroy']);

Route::get('/availability', [ProfessionalAvailabilityController::class, 'index']);
Route::post('/availability', [ProfessionalAvailabilityController::class, 'store']);
Route::get('/availability/{id}', [ProfessionalAvailabilityController::class, 'show']);
Route::put('/availability', [ProfessionalAvailabilityController::class, 'update']);
Route::delete('/availability/{id}', [ProfessionalAvailabilityController::class, 'destroy']);

Route::post('/availability/getHours', [ProfessionalAvailabilityController::class, 'getHours']);
Route::post('/availability/reserveSlot', [ProfessionalAvailabilityController::class, 'reserveSlot']);
Route::get('/availability/cancelSlot/{id}', [ProfessionalAvailabilityController::class, 'cancelSlot']);
