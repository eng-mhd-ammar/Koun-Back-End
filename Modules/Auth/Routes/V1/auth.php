<?php

namespace Modules\Auth\Routes\V1;

use Illuminate\Support\Facades\Route;

Route::middleware([])->group(
    function () {
        // Route::middleware(['guest'])->group(function() {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::post('/check-otp', 'checkOtp');
        Route::post('/send-otp', 'sendCode');
        Route::post('/refresh', 'refresh');
        // });

        // Route::middleware(['auth:user'])->group(function() {
        Route::post('/reset-password', 'resetPassword');
        // });
    }
);
