<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;




Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('/store', [ContactController::class, 'store'])->name('store');




// 認証が必要なグループ
Route::middleware('auth')->group(function () {

    Route::get('/admin', [AuthorController::class, 'index']);
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/author/{author}', [AuthorController::class, 'bind']);
    Route::get('/find', [AuthorController::class, 'find']);
    Route::post('/find', [AuthorController::class, 'search']);
});
