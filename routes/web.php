<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::name('admin.')->prefix('admin')->middleware(['auth', 'admin', 'verified'])->group(function() {
	Route::get('/', [HomeController::class, 'dashboard']);
	Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::resource('product', ProductController::class, ['except' => [
		'create', 'show'
	]]);
	Route::resource('category', CategoryController::class, ['except' => [
		'create', 'show'
	]]);
	Route::resource('discount', DiscountController::class, ['except' => [
		'create', 'show'
	]]);
	Route::patch('user/{user}/change-password', [UserController::class, 'changePassword'])->name('user.password');
	Route::resource('user', UserController::class, ['except' => [
		'create', 'show'
	]]);
});

Route::middleware('auth')->group(function () {
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::name('user.')->middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

require __DIR__.'/auth.php';

// Auth::routes();
