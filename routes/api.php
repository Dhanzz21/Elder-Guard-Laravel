<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SensorController;
Route::post('/sensor/data', [SensorController::class, 'storeData']);
Route::get('/sensor/latest/{perangkat_id}', [SensorController::class, 'getLatest']);