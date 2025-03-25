<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->group(function () {
    //Auth Routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Route::apiResource('users', UserController::class);
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);

    Route::post('location', [LocationController::class, 'createLocation']);
    Route::get('location', [LocationController::class, 'getLocations']);
    Route::get('location/{id}', [LocationController::class, 'getLocation']);
    Route::put('location/{id}', [LocationController::class, 'updateLocation']);
    Route::delete('location/{id}', [LocationController::class, 'deleteLocation']);

    Route::post('Role', [RoleController::class, 'createRole']);
    Route::get('Role', [RoleController::class, 'getRoles']);
    Route::get('Role/{id}', [RoleController::class, 'getRole']);
    Route::put('Role/{id}', [RoleController::class, 'updateRole']);
    Route::delete('Role/{id}', [RoleController::class, 'deleteRole']);
});