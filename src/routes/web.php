<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;

// --- 修正後のイメージ ---

// 【追加】お問い合わせ関連（ログイン不要なのでグループの外！）
Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('/store', [ContactController::class, 'store'])->name('store');

// 中略（他のルートなど）

// 認証が必要なグループ
Route::middleware('auth')->group(function () {
    // ここに /author/{author} や /find が残っていればOKです
    Route::get('/author/{author}', [AuthorController::class, 'bind']);
    Route::get('/find', [AuthorController::class, 'find']);
    Route::post('/find', [AuthorController::class, 'search']);

    // その他、認証が必要なルートたち...
});
