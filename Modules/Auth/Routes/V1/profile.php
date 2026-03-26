<?php

namespace Modules\Auth\Routes\V1;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:user'])->group(
    function () {
        Route::post('/update', 'update');
        Route::delete('/delete', 'delete');
        Route::get('/show', 'show');

        Route::prefix('')->group(function () {
            Route::post('/phone-update/request', 'phoneUpdateRequest');
            Route::post('/phone-update/send-otp', 'phoneUpdateSendOtp');
            Route::post('/phone-update/check-otp', 'phoneUpdateCheckOtp');
        });
    }
);
