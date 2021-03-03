<?php

use Illuminate\Support\Facades\Route;
use Tipoff\Waivers\Http\Controllers\Web\WaiverController;

Route::prefix('waiver')->group(function () {
    Route::get('/', [WaiverController::class, 'index'])->name('waiver');
    Route::get('{location}', [WaiverController::class, 'show'])->name('form');
    Route::post('sign', [WaiverController::class, 'sign']);
});
