<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;


Route::get('customers/create', [CustomerController::class, 'create']);
Route::post('customers/store', [CustomerController::class, 'store']);

