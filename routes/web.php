<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;

Route::get('/demo', [DemoController::class, 'demo'])->name('demo');