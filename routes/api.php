<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRController;

// No es necesario colocar/api. ya que la class lo coloca como prefijo.

Route::get('/qr', [QRController::class, 'api']);
