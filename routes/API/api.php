<?php

use App\Http\Controllers\API\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileUser;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/profile', [ProfileUser::class, 'show']);

    Route::get('/books', [BookController::class, 'index']);
    Route::post('/books', [BookController::class, 'store']);
    Route::get('/books/{book}', [BookController::class, 'show']);

    Route::put('/books/{book}', [BookController::class, 'update'])
        ->middleware('can:update,book');

    Route::patch('/books/{book}', [BookController::class, 'update'])
        ->middleware('can:update,book');

    Route::delete('/books/{book}', [BookController::class, 'destroy'])
        ->middleware('can:delete,book');
});



