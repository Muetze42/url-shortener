<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('{url}', RedirectController::class)
    ->where('url', '.*')
    ->name('redirect');
