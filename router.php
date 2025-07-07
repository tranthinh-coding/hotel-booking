<?php

use HotelBooking\Controllers\Admin\AdminController;
use HotelBooking\Facades\Route;
use HotelBooking\Controllers\HomeController;

Route::group('admin', function () {
    Route::get('dashboard', AdminController::class, 'index');
});

Route::get('/', HomeController::class, 'index');
