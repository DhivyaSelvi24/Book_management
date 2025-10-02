<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

Route::get('/csrf-token', function () {
    return csrf_token();
    
});

Route::resource('books',BooksController::class);
