<?php

use App\Http\Controllers\CelestialController;
use Illuminate\Support\Facades\Route;

Route::apiResource('celestials', CelestialController::class);
