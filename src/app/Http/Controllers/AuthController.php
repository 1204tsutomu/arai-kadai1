<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{ // ← クラスの開始の波括弧が必要です！

    // お問い合わせ一覧（トップページ）を表示する場合
    public function index2()
    {
        return view('index2');
    }

    // ログイン画面を表示する場合
    public function showLogin()
    {
        return view('auth.login');
    }

    // 会員登録画面を表示する場合
    public function showRegister()
    {
        return view('auth.register');
    }
} // ← クラスの終わりの波括弧