<?php

use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

Route::get('{url}', RedirectController::class)
    ->where('url', '.*')
    ->name('redirect');
