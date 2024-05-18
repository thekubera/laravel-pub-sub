<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProducerController;

Route::get('/', [ProducerController::class, 'produceMessage']);

