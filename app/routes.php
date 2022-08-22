<?php

use App\Controllers\MainController;
use Core\Route;

Route::get('/exchange-rate', MainController::class, 'getExchangeRate');
