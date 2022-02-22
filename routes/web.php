<?php

use Illuminate\Support\Facades\Route;
use App\Mail\ItemBoughtMail;
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


Auth::routes();

Route::get('/email', function(){
    Mail::to('email@mail.com')->send(new ItemBoughtMail());
    return new ItemBoughtMail();
});

Route::get('/adminpannel', [App\Http\Controllers\AdminController::class, 'index']);
Route::get('/remove/user/{user}', [App\Http\Controllers\AdminController::class, 'rmvUser']);
Route::get('/remove/{product}', [App\Http\Controllers\AdminController::class, 'remove']);
Route::get('/update/{product}', [App\Http\Controllers\AdminController::class, 'update']);

Route::get('/', [App\Http\Controllers\FrontController::class, 'index']);
Route::get('/home', [App\Http\Controllers\FrontController::class, 'index'])->name('home');
Route::get('/sucess',[App\Http\Controllers\FrontController::class, 'sucess']);
Route::get('/failed',[App\Http\Controllers\FrontController::class, 'failed']);
Route::get('/search', [App\Http\Controllers\FrontController::class, 'search']);

Route::get('/p/create',[App\Http\Controllers\PostController::class, 'create']);
Route::post('/p',[App\Http\Controllers\PostController::class, 'store']);
Route::patch('/p/{product}', [App\Http\Controllers\AdminController::class, 'edit']);
Route::get('/cmnt/{product}', [App\Http\Controllers\PostController::class, 'postCmnt']);
Route::get('/deactivate/{user}', [App\Http\Controllers\PostController::class, 'deactivate']);


Route::get('/cart', [App\Http\Controllers\CartController::class, 'index']);
Route::get('/cart/cancel', [App\Http\Controllers\CartController::class, 'cancelCart']);
Route::get('/cart/add/{item}', [App\Http\Controllers\CartController::class, 'addItem']);
Route::get('/cart/remove/{item}', [App\Http\Controllers\CartController::class, 'removeItem']);