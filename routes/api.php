<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('Role', [RoleController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    //Auth Routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Route::apiResource('users', UserController::class);
    Route::get('user', [UserController::class, 'getUser']);
    Route::post('user', [UserController::class, 'store']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::post('user/updateProfile', [UserController::class, 'updateProfile']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
    Route::post('/mentor/{mentorId}/message', [MessageController::class, 'store']);
    Route::get('/mentor/messages', [MessageController::class, 'getMentorMessages']);

    Route::post('location', [LocationController::class, 'createLocation']);
    Route::get('location', [LocationController::class, 'getLocations']);
    Route::get('location/{id}', [LocationController::class, 'getLocation']);
    Route::put('location/{id}', [LocationController::class, 'updateLocation']);
    Route::delete('location/{id}', [LocationController::class, 'deleteLocation']);

    Route::post('Role', [RoleController::class, 'createRole']);
    // Route::get('Role', [RoleController::class, 'getRoles']);
    Route::get('Role/{id}', [RoleController::class, 'getRole']);
    Route::put('Role/{id}', [RoleController::class, 'updateRole']);
    Route::post('Role/{id}/permissions', [RoleController::class, 'assignPermissionsToRole']);
    Route::get('Role/{id}/permissions', [RoleController::class, 'getPermissionsbyRole']);
    Route::get('Role/{id}/permissions/{permissionId}', [RoleController::class, 'view-dashboard']);
    Route::delete('Role/{id}', [RoleController::class, 'deleteRole']);
});
