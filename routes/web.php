<?php

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
use App\Http\Controllers\PurchaseController;

Route::get('/', function () {
    return view('welcome');
});



Route::post('/purchase', [PurchaseController::class, 'store']);
// routes/web.php
use App\Http\Controllers\RegistrationController;

// Route::get('/register', [RegistrationController::class, 'showForm'])->name('register.form');

// Route to display the registration form
// use App\Http\Controllers\RegistrationController;



Route::get('/register_form', [RegistrationController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');


