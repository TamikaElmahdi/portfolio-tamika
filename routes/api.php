<?php

use App\Http\Controllers\Api\BlogController;
use Illuminate\Support\Facades\Route;

Route::post('/blogs', [BlogController::class, 'store'])
    ->middleware('api.secret');