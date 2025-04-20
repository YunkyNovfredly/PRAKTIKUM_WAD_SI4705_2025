<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// ==================1==================
// Tambahkan route GET ke /dashboard yang memanggil method index() dari DashboardController
Route::get('/', [DashboardController::class, 'index']);