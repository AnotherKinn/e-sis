<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Siswa\IzinController;

// default route bawaan API (opsional)
Route::get('/user', function (Request $request) {
    return $request->user();
});

// endpoint izin
Route::post('/izin', [IzinController::class, 'store']);
