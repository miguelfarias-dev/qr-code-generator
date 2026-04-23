<?php

use App\Http\Controllers\QRController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('qr.index');
// });

Route::get('/', [QRController::class, 'index']);
Route::post('/download', [QRController::class, 'download'])->name('qr.download');
