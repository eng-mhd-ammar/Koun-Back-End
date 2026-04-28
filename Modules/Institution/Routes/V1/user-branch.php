<?php

namespace Modules\Institution\Routes\V1;

use Illuminate\Support\Facades\Route;
use Modules\Auth\Middlewares\IsAdmin;

Route::middleware(['auth:api'])->group(function (): void {
    Route::get('/', 'index');
    Route::get('/show/{modelId}', 'show');

    Route::middleware(['ensure_institution_admin:branch'])->group(function (): void {
        Route::post('/create', 'create');
        Route::post('/update/{modelId}', 'update');
        Route::delete('/delete/{modelId}', 'delete');
    });

    Route::middleware([new IsAdmin])->group(function (): void {
        Route::delete('/force-delete/{modelId}', 'forceDelete');
        Route::get('/restore/{modelId}', 'restore');
    });
});
