<?php

use HotelBooking\Facades\Route;
use HotelBooking\Controllers\HomeController;

Route::get('/a', HomeController::class, 'index');
