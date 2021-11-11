<?php

use Illuminate\Support\Facades\Route;
use FuryBee\ArtisanUi\Http\Controllers\HomeController;

Route::prefix('artisan-ui')
    ->middleware('artisan-ui')
    ->group(function () {
        Route::get('/{view?}', HomeController::class)->where('view', '(.*)')->name('artisan-ui');
    });
