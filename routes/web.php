<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserSettingController;

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

// Auth
Auth::routes();
Route::middleware('auth')->group( function(){
    // Admin
    Route::group(['middleware' => 'admin'], function (){
        Route::get('/admin/book', [AdminBookController::class, 'index'])->name('admin.book.index');
        Route::get('/admin/book/approve/{book}', [AdminBookController::class, 'approveBook'])->name('admin.book.change.approved');
        Route::get('/admin/book/edit/{book}', [AdminBookController::class, 'edit'])->name('admin.book.edit');
        Route::put('/admin/book/update/{book}', [AdminBookController::class, 'update'])->name('admin.book.update');
    });
    // User
    Route::resource('/book', BookController::class)->only([
        'store',
        'create',
        'update',
        'edit',
        'destroy'
    ]);    
    Route::get('/user/book', [UserBookController::class, 'index'])->name('user.book');
    // User Settings
    Route::get('user/setting',[ UserSettingController::class, 'index'])->name('user.setting.index');
    Route::post('user/setting/password/update', [ UserSettingController::class, 'updatePassword'])->name('user.password.update');
    Route::post('user/setting/email/update', [ UserSettingController::class, 'updateEmail'])->name('user.email.update');
    // Reports
    Route::get('/report/index', [ReportController::class, 'index'])->name('report.index');
    Route::post('/report/store/{book}', [ReportController::class, 'store'])->name('report.store');
    Route::get('/report/show/{report}', [ReportController::class, 'show'])->name('report.show');
    // Message Ticket System
    Route::post('/report/message/store/{report}', [ReportController::class ,'reportMessageStore'])->name('report.message.store');
    // Review
    Route::post('/review/store/{book}', [ReviewController::class, 'store'])->name('review.store');
    Route::post('/review/index/{book}', [ReviewController::class, 'index'])->name('review.index');

});
// Guest
Route::resource('/book', BookController::class)->only([
    'index',
    'show'
]);
// Root
Route::get('/', function(){
    return redirect()->route('book.index');
});
