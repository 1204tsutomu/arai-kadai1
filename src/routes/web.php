<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

// --- 公開ページ（誰でも見れる） ---

// 1. お問い合わせ入力画面
Route::get('/', [ContactController::class, 'index']);

// 2. 確認画面へ進む
Route::post('/confirm', [ContactController::class, 'confirm']);

// 3. 完了画面へ（保存処理）
Route::post('/store', [ContactController::class, 'store']);

// 4. 認証画面の表示（これが必要！）
// Route::get('/login', [AuthController::class, 'showLogin']);
Route::get('/register', [AuthController::class, 'showRegister']);


// --- 管理ページ（ログインした人だけ見れる） ---

Route::middleware('auth')->group(function () {
    // ログイン後、お問い合わせ一覧を表示するルート
    // URLを '/' から '/admin' に変えることで、入力画面との衝突を防ぎます
    Route::get('/admin', [AuthController::class, 'index2']);
});
