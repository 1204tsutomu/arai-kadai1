<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// 1. お問い合わせ入力画面を表示（ここでカテゴリーを取得する）
Route::get('/', [ContactController::class, 'index']);

// 2. 確認画面へ進む
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);

// 3. 完了画面へ（保存処理）
Route::post('/contacts', [ContactController::class, 'store']);
