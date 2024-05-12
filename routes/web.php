<?php

use App\Http\Controllers\ProfessionalAvailabilityController;
use App\Http\Controllers\ProfessionalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $routes = Route::getRoutes();

    return view('welcome', compact('routes'));
});


