<?php

use App\Http\Controllers\BookingController;
use App\Http\Livewire\CreateBooking;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::get('/bookings/create', BookingController::class);
Route::get('/bookings/create', CreateBooking::class);

require __DIR__ . '/auth.php';
