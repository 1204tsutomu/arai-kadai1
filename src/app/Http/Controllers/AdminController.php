<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AdminController extends Controller
{
    // ★ここ！「destroy」という名前の関数（箱）を作って、ルートから送られてくる $id を受け取ります
    public function destroy($id)
    {
        // 1. 該当するデータをIDで探す
        $contact = Contact::findOrFail($id);

        // 2. データを削除する
        $contact->delete();

        // 3. 管理画面（一覧）に戻る
        return redirect('/admin')->with('success', 'お問い合わせを削除しました');
    }
}
