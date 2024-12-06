<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\LoanController;
use App\Http\Controllers\API\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {

    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware(CheckRole::class)->group(function () {
        //Book routes
        Route::apiResource('/books', BookController::class);

        //Category routes
        Route::apiResource('/categories', CategoryController::class);

        //Loan routes
        Route::apiResource('/loans', LoanController::class);
    });

    //User
    Route::apiResource('/users', UserController::class)->except('store');

    Route::post('logout', [AuthController::class, 'logout']);
});
