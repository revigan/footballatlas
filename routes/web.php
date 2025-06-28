<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NegaraController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\KlubController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\PrestasiNegaraController;

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

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('captcha/reload', [CaptchaController::class, 'reload'])->name('captcha.reload');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Redirect root to home
Route::get('/', function () {
    return view('home');
});

// Admin routes with full CRUD access
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('negara', NegaraController::class);
    Route::resource('klub', KlubController::class);
    Route::post('/negara/{negara}/prestasi-negara', [PrestasiNegaraController::class, 'store'])->name('prestasi-negara.store');
    Route::delete('/klub/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    Route::delete('/negara/prestasi-negara/{id}', [PrestasiNegaraController::class, 'destroy'])->name('prestasi-negara.destroy');
});

// User routes (read-only)
Route::middleware(['auth'])->group(function () {
    Route::get('/negara', [NegaraController::class, 'index'])->name('negara.index');
    Route::get('/negara/{negara}', [NegaraController::class, 'show'])->name('negara.show');
    Route::get('/negara/{negara}/prestasi', [\App\Http\Controllers\NegaraController::class, 'prestasi'])->name('negara.prestasi');
    Route::get('/klub', [KlubController::class, 'index'])->name('klub.index');
    Route::get('/klub/{klub}', [KlubController::class, 'show'])->name('klub.show');
    Route::get('/klub/{klub}/prestasi', [\App\Http\Controllers\KlubController::class, 'prestasi'])->name('klub.prestasi');
});

Route::post('/klub/{klub}/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');

require __DIR__.'/auth.php';
