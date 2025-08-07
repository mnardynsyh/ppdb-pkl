<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/books', [App\Http\Controllers\BookController::class, 'index'])->name('books.index');