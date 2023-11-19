<?php

use App\Http\Controllers\Api\ToggleFavoriteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StartpageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', StartpageController::class)
  ->name('start-page');

Route::get('/dashboard', DashboardController::class)
  ->middleware(['auth'])
  ->name('dashboard');

Route::post('favorites/toggle', ToggleFavoriteController::class)
  ->middleware(['auth'])
  ->name('favorites.toggle');

require __DIR__.'/auth.php';
