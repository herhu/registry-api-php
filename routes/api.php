<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistryController;



Route::middleware('api')->group(function () {
    Route::post('add', [RegistryController::class, 'add']);
    Route::delete('remove', [RegistryController::class, 'remove']);
    Route::get('check', [RegistryController::class, 'check']);
    Route::post('diff', [RegistryController::class, 'diff']);
    Route::post('invert', [RegistryController::class, 'invert']);
    
    // Test session persistence
    Route::get('set-session', [RegistryController::class, 'setSession']);
    Route::get('get-session', [RegistryController::class, 'getSession']);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
