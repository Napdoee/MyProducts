<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
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

// Route::get('/test', function() {
// 	$response = Http::get('https://dummyjson.com/products', [
// 		'limit' => 5
// 	])->body();
// 	$response_json = json_decode($response);

// 	$data = [];
// 	foreach($response_json->products as $item) {
// 		$data[] = $item->title;
// 	}

// 	return $data;
// });

//Public 
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/products', [HomeController::class, 'products'])->name('product');
Route::get('/product/{product:slug}', [HomeController::class, 'productDetail'])->name('product.details');

//Admin Only 
Route::name('admin.')->prefix('admin')->middleware(['auth', 'admin', 'verified'])->group(function() {
	Route::get('/', [HomeController::class, 'dashboard']);
	Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::get('/order', [OrderController::class, 'getAll'])->name('order.index');
	Route::get('/order/{order}', [OrderController::class, 'edit'])->name('order.edit');
	Route::put('/order/{order}', [OrderController::class, 'update'])->name('order.update');
	Route::resource('product', ProductController::class, ['except' => [
		'create', 'show'
	]])->parameters([
		'product' => 'product:slug'
	]);
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

//Must auth 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Mush auth and verified USERS
Route::middleware(['auth', 'verified'])->group(function () {
	Route::resource('cart', CartController::class, ['only' => [
		'index', 'store', 'update', 'destroy'
	]]);
	Route::get('/checkout', [OrderController::class, 'index'])->name('checkout');
	Route::get('/order', [OrderController::class, 'show'])->name('order.show');
	Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');
	// Route::get('/finish', function(){
	// 	return view('user.finish');
	// })->name('order.finish');
});

require __DIR__.'/auth.php';

// Auth::routes();
