<?php

use App\Http\Controllers\Api\v1\ExtraItemsController;
use App\Http\Controllers\Api\v1\ItemsController;

Route::get('/items', [ItemsController::class, 'index']);
Route::get('/extra-items', [ExtraItemsController::class, 'index']);
