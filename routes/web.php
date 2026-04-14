<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

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

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactSubmit'])->name('contact.submit');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Book routes
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

// Cart routes
Route::post('/cart/add/{bookId}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
Route::post('/cart/update/{bookId}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::post('/cart/remove/{bookId}', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear')->middleware('auth');

// Favorite routes
Route::post('/favorites/toggle/{bookId}', [FavoriteController::class, 'toggle'])->name('favorites.toggle')->middleware('auth');
Route::get('/favorites', [FavoriteController::class, 'view'])->name('favorites.view')->middleware('auth');
Route::post('/favorites/remove/{bookId}', [FavoriteController::class, 'remove'])->name('favorites.remove')->middleware('auth');

// Order routes
Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout')->middleware('auth');
Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');
Route::get('/orders', [OrderController::class, 'history'])->name('orders.history')->middleware('auth');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show')->middleware('auth');

// Profile routes
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Books management
    Route::get('/books', [AdminController::class, 'listBooks'])->name('books.list');
    Route::get('/books/create', [AdminController::class, 'createBook'])->name('books.create');
    Route::post('/books', [AdminController::class, 'storeBook'])->name('books.store');
    Route::get('/books/{id}/edit', [AdminController::class, 'editBook'])->name('books.edit');
    Route::put('/books/{id}', [AdminController::class, 'updateBook'])->name('books.update');
    Route::delete('/books/{id}', [AdminController::class, 'deleteBook'])->name('books.delete');
    
    // Orders management
    Route::get('/orders', [AdminController::class, 'listOrders'])->name('orders.list');
    Route::put('/orders/{id}', [AdminController::class, 'updateOrderStatus'])->name('orders.update-status');
});

