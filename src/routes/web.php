<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;

Route::get('/author/{author}', [AuthorController::class, 'bind']);
Route::get('/find', [AuthorController::class, 'find']);
Route::post('/find', [AuthorController::class, 'search']);

// 1. お問い合わせ入力画面
Route::get('/', [ContactController::class, 'index'])->name('contact.index');

// 2. 確認画面へ進む（URLから contacts/ を削る）
Route::post('/confirm', [ContactController::class, 'confirm'])->name('confirm');

// 3. 完了画面へ（ここも URLから contacts/ を削る）
Route::post('/store', [ContactController::class, 'store'])->name('store');

// 4. 登録画面
Route::get('/register', [AuthController::class, 'showRegister']);

// Route::get('/admin', [ContactController::class, 'admin'])->name('admin');
Route::get('/admin', [AuthorController::class, 'index']);
// --- 管理ページ ---
Route::get('/authors', [AuthorController::class, 'index']);
Route::middleware('auth')->group(function () {
    // AuthController::index2 から ContactController::admin へ変更

});
