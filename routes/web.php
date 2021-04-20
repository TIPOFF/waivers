<?php

use Illuminate\Support\Facades\Route;
use Tipoff\Waivers\Http\Controllers\WaiverController;

Route::middleware(config('tipoff.web.middleware_group'))
    ->prefix(config('tipoff.web.uri_prefix'))
    ->group(function () {

        Route::prefix('waiver')->group(function () {
            Route::get('/', [WaiverController::class, 'index'])->name('waiver.index');
            Route::get('{location}', [WaiverController::class, 'show'])->name('waiver.form');
            Route::post('{location}/sign', [WaiverController::class, 'sign'])->name('waiver.sign');
            Route::get('{location}/confirmation', [WaiverController::class, 'confirmation'])->name('waiver.confirmation');
        });

    });
