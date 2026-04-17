<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

// هذا السطر القديم اللي بيعرض الجدول
Route::get('/customers', [CustomerController::class, 'index']);

// --- أضيفي هذا السطر الجديد الآن ---
Route::post('/customers', [CustomerController::class, 'store']);
Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);
Route::post('/customers/{id}/pay', [App\Http\Controllers\CustomerController::class, 'pay']);