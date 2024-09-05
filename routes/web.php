<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// Route các tác vụ CRUD cho Category
Route::get('/categories',[CategoryController::class,'index'])->name('categories.index')->middleware('auth');
Route::post('/categories/store',[CategoryController::class,'store'])->name('categories.store')->middleware('auth');
Route::put('/categories/{id}',[CategoryController::class,'update'])->name('categories.update')->middleware('auth');
Route::delete('/categories/{id}',[CategoryController::class,'destroy'])->name('categories.destroy')->middleware('auth');

// Route các tác vụ CRUD cho Product
Route::get('/products',[ProductController::class,'index'])->name('products.index')->middleware('auth');
Route::post('/products/store',[ProductController::class,'store'])->name('products.store')->middleware('auth');
Route::put('/products/{id}',[ProductController::class,'update'])->name('products.update')->middleware('auth');
Route::delete('/products/{id}',[ProductController::class,'destroy'])->name('products.destroy')->middleware('auth');

// Route các tác vụ CRUD cho Lot
Route::get('/lots',[LotController::class,'index'])->name('lots.index')->middleware('auth');
Route::post('/lots/store',[LotController::class,'store'])->name('lots.store')->middleware('auth');
Route::put('/lots/{id}',[LotController::class,'update'])->name('lots.update')->middleware('auth');
Route::delete('/lots/{id}',[LotController::class,'destroy'])->name('lots.destroy')->middleware('auth');

