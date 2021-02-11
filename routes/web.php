<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function(){
    return redirect()->route('book.index');
});
//book
Route::resource('/book', App\Http\Controllers\BookController::class);
Route::get('/book/myBooks/{id}', [App\Http\Controllers\BookController::class, 'getAllUserBooks'])->name('userBook');
//Review
Route::post('/review/store/{book_id}/{user_id}', [App\Http\Controllers\ReviewController::class, 'store' ])->name('review.store');
Route::post('/review/index/{book_id}', [App\Http\Controllers\ReviewController::class, 'index' ])->name('review.index');
//admin

Route::group(['middleware' => 'admin'], function (){
    
});
