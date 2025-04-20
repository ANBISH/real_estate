<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'check_blocked'])->group(function () {

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::patch('/users/{id}/toggle-block', [UserController::class, 'toggleBlock'])->name('admin.users.toggle-block');
    });

    Route::middleware('role:agent')->group(function () {

    });

    Route::middleware('role:client')->group(function () {

    });
});

require_once __DIR__ . '/auth/auth.php';
