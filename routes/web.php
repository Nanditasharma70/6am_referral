<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/purchase', [PurchaseController::class, 'store']);

// Registration Routes
Route::get('/register_form', [RegistrationController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');

// Login Routes
Route::get('login', [LoginController::class, 'showForm'])->name('login.form');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard Route
Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard')->middleware('auth');
