<?php

namespace Modules\Auth\Routes\V1;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:user', 'is_admin'])->group(function () {
    Route::get('/', 'index');
    Route::get('/show/{user_id}', 'show');
    Route::post('/create', 'create');
    Route::delete('/delete/{user_id}', 'delete');
    Route::post('/update/{user_id}', 'update');
    Route::delete('/force-delete/{user_id}', 'forceDelete');
    Route::get('/restore/{user_id}', 'restore');
});
