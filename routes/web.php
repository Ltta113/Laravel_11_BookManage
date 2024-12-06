<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\LoanController;
use App\Http\Controllers\Web\UserController;
use App\Http\Middleware\Web\CheckAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('welcome');
});
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registerPost', [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/login', [AuthController::class, 'login'])->name('loginWeb');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('loginWeb.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin', function () {

    return view('auth.index');
})->name('admin');

Route::middleware([CheckAdmin::class])->group(function () {
    Route::resource('books', BookController::class)->except('index', 'show');
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class)->only('index', 'show', 'destroy');
    Route::resource('loans', LoanController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('books', [BookController::class, 'index'])->name('books.index');
    Route::get('loansBook/{book}', [LoanController::class, 'loanBooksView'])->name('loans.loanBooksView');
    Route::post('loansUsers/loan', [LoanController::class, 'userLoanBooks'])->name('loans.userLoanBooks');
    Route::get('loansUsers', [LoanController::class, 'userIndex'])->name('loans.userIndex');
    Route::get('user/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('user/update', [UserController::class, 'update'])->name('users.update');
});
