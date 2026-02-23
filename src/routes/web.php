<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;

Route::get('/author/{author}', [AuthorController::class, 'bind']);
Route::get('/find', [AuthorController::class, 'find']);
Route::post('/find', [AuthorController::class, 'search']);

// --- routes/web.php ---

// 既存の他のルート（入力画面や確認画面など）はこの上に残したままでOKです

// ユーザー認証が必要なルートをグループにまとめます
Route::middleware('auth')->group(function () {
    Route::get('/author/{author}', [AuthorController::class, 'bind']);
    Route::get('/find', [AuthorController::class, 'find']);
    Route::post('/find', [AuthorController::class, 'search']);
    Route::get('/admin', [AuthorController::class, 'index']);
    Route::get('/authors', [AuthorController::class, 'index']);
});
