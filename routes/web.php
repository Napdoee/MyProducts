<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

/*Route::controller(ProductController::class)->middleware('auth')->group(function() {
	Route::get('/product', 'index')->name('product.index');
	Route::get('/product/{id}/edit', 'edit')->name('product.edit');
	Route::put('/product/{id}', 'update')->name('product.update');
	Route::post('/product', 'store')->name('product.store');
	Route::delete('/product/{id}', 'destroy')->name('product.destroy');	
});*/

Route::resource('product', ProductController::class, ['except' => [
	'create', 'show'
]])->middleware('auth');

Route::resource('student', StudentController::class, ['except' => [
	'create', 'show'
]])->middleware('auth');

Route::resource('teacher', TeacherController::class, ['except' => [
	'create', 'show'
]])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Auth::routes();
