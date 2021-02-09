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

Route::get('/',[ App\Http\Controllers\BookController::class, 'index'  ]);
Route::get('/Book/{id}',[ App\Http\Controllers\BookController::class, 'bookById'  ])->name('SingleBook');

Route::group(['middleware' => 'auth', 'prefix' => 'BookStore'], function(){
    Route::get('/addBook', [ App\Http\Controllers\BookController::class, 'create'])->name('addBookView');
    Route::post('/addBook', [ App\Http\Controllers\BookController::class, 'store'])->name('bookCreate');
});






