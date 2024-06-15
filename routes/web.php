<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

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



Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/products/index', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/fetch', [ProductController::class, 'fetch'])->name('products.fetch');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/index', [CartController::class, 'index'])->name('cart.index');
