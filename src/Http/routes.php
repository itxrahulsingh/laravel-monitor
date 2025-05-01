<?php

use Illuminate\Support\Facades\Route;

Route::middleware(config('laravel-monitor.dashboard.middleware'))
    ->prefix(config('laravel-monitor.dashboard.route'))
    ->group(function () {
        Route::get('/', function () {
            return view('laravel-monitor::dashboard');
        })->name('monitor.dashboard');
    });
