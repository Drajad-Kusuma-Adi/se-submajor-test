<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\StudentsController;
use App\Http\Middleware\CheckToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [StudentsController::class, 'login']);
Route::post('/logout', [StudentsController::class, 'logout']);

// Route::middleware(CheckToken::class)->group(function () {
//     Route::get('/books', [BooksController::class, 'getBooks']);
//     Route::put('/books', [BooksController::class, 'borrow']);
// });

Route::get('/books', [BooksController::class, 'getBooks']);
Route::put('/books', [BooksController::class, 'borrow']);
