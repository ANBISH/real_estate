<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'check_blocked'])->group(function () {

    Route::middleware('role:admin')->group(function () {

    });

    Route::middleware('role:agent')->group(function () {

    });

    Route::middleware('role:client')->group(function () {

    });
});

require_once __DIR__ . '/auth/auth.php';
