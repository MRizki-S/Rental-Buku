<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\BookRentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SendEmailController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/',[PublicController::class, 'index']);

// route untuk kirim email
Route::get('send-email', [SendEmailController::class, 'index']);
// route email ke gmail
Route::get('/kirim-email', [SendEmailController::class, 'index']);

                        //name untuk memberikan nama route agar saat auth dapat dikenali
Route::middleware(['only-guest'])->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticating']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registerAuth']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('profile', [UserController::class, 'profile'])->middleware(['only-client']);


    Route::middleware('only-admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::get('books', [BookController::class, 'index']);
        Route::get('book-add', [BookController::class, 'addDataForm']);
        Route::post('book-add', [BookController::class, 'store']);
        Route::get('book-edit/{slug}', [BookController::class, 'editDataForm']);
        Route::put('book-edit/{slug}', [BookController::class, 'update']);
        // Delete data Book
        Route::get('book-delete/{slug}', [BookController::class, 'destroy']);
        Route::get('show-bookDeleted', [BookController::class, 'showBookDeleted']);
        Route::get('book/{slug}/restore', [BookController::class, 'restore']);
        Route::get('book/{slug}/deletePermanent', [BookController::class, 'deletePermanently']);

        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('category-add', [CategoryController::class, 'addDataForm']);
        Route::post('category-add', [CategoryController::class, 'store']);
        // Route::get('category-edit/{slug}', [CategoryController::class, 'editDataForm']);
        Route::put('category-edit/{slug}', [CategoryController::class, 'update']);
        // delete data category
        // Route::get('category-confirmDelete/{slug}', [CategoryController::class, 'formConfirmDelete']);
        Route::get('category-delete/{slug}', [CategoryController::class, 'destroy']);
        Route::get('show-categoryDeleted', [CategoryController::class, 'showCategoryDeleted']);
        Route::get('category/{slug}/restore', [CategoryController::class, 'restore']);
        Route::get('category/{slug}/deletePermanent', [CategoryController::class, 'deletePermanently']);

        Route::get('users', [UserController::class, 'index']);
        Route::get('user-detail/{slug}', [UserController::class, 'userActiveDetail']);
        // route ban akun / delete akun user yang sudah di active
        Route::get('user-ban/{slug}', [UserController::class, 'delete']);
        Route::get('show-bannedUser', [UserController::class, 'showBannedUser']);
        Route::get('user/{slug}/restore', [UserController::class, 'restore']);
        Route::get('user/{slug}/deletePermanent', [UserController::class, 'deletePermanently']);
                // route akun user yang belum active (inactive)
        Route::get('newRegister-user', [UserController::class, 'newRegisterUser']);
        // route approve user
        Route::get('user-approve/{slug}', [UserController::class, 'userApprove']);

        Route::get('book-rent', [BookRentController::class, 'index']);
        Route::post('book-rent', [BookRentController::class, 'storeAction']);

        Route::get('rent-logs', [RentLogController::class, 'index']);

        // route untuk pengemnbalian buku
        Route::get('book-return', [BookRentController::class, 'returnBook']);
        Route::post('book-return', [BookRentController::class, 'returnBookAction']);
    });


});
