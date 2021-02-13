<?php

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
Route::get('/books', [App\Http\Controllers\BookController::class , 'search'])->name('books.search');

//Review
Route::post('/review/store/{book_id}/{user_id}', [App\Http\Controllers\ReviewController::class, 'store' ])->name('review.store');
Route::post('/review/index/{book_id}', [App\Http\Controllers\ReviewController::class, 'index' ])->name('review.index');

//admin
Route::group(['middleware' => 'admin'], function (){
    Route::get('/admin/book',[ App\Http\Controllers\BookController::class , 'indexAdminBookUnapproved'])->name('admin.book.index');
    Route::get('/admin/book/{book}/{status}',[ App\Http\Controllers\BookController::class , 'bookChangeApproved'])->name('admin.book.change.approved');
});

//reports
Route::get('/report/index', [App\Http\Controllers\ReportController::class, 'index'])->name('report.index');
Route::post('/report/store/{book_id}', [App\Http\Controllers\ReportController::class, 'store'])->name('report.store');
Route::get('/report/show/{report}', [App\Http\Controllers\ReportController::class, 'show'] )->name('report.show');
Route::post('/report/message/store/{report_id}', [App\Http\Controllers\ReportController::class ,'reportMessageStore'])->name('report.message.store');