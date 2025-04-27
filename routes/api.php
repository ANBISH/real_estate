<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Agent\PropertyController as AgentPropertyController;
use App\Http\Controllers\Api\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Api\PropertyController as ViewPropertyController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'check_blocked'])->group(function () {

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::patch('/users/{id}/toggle-block', [UserController::class, 'toggleBlock'])->name('admin.users.toggle-block');
        Route::prefix('/properties')->group(function (){
            Route::get('/', [AdminPropertyController::class, 'index'])->name('admin.properties');
            Route::put('/{property}', [AdminPropertyController::class, 'updateStatus'])->name('admin.properties.status');
        });
    });

    Route::prefix('agent')->middleware('role:agent')->group(function () {
        Route::apiResource('/properties', AgentPropertyController::class);
    });

    // Route::middleware('role:client')->group(function () {

    // });
});

Route::prefix('/properties')->group(function (){
    Route::get('/', [ViewPropertyController::class, 'index'])->name('view.properties');
    Route::get('/{property}', [ViewPropertyController::class, 'show'])->name('view.properties.show');
});

require_once __DIR__ . '/auth/auth.php';
