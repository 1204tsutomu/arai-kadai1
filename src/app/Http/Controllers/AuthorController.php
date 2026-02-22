<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function find()
    {
        return view('find', ['input' => '']);
    }

    // AuthorController.php の index メソッドを以下のように修正
    public function index(Request $request)
    {
        // 検索クエリの開始
        $query = Author::query();

        // 1. 名前またはメールアドレスで検索
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('last_name', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('email', 'LIKE', "%{$request->keyword}%");
            });
        }

        // 2. 性別で検索 (1:男性, 2:女性, 3:その他)
        if ($request->filled('gender') && $request->gender != 'all') {
            $query->where('gender', $request->gender);
        }

        // 3. お問い合わせの種類で検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 4. 日付で検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 絞り込んだ結果をページネーションで取得
        $contacts = $query->paginate(7);

        return view('admin', compact('contacts'));
    }

    public function search(Request $request)
    {
        // 入力された文字が、first_name か last_name のどちらかに含まれていれば取得
        $item = Author::where('first_name', 'LIKE', "%{$request->input}%")
            ->orWhere('last_name', 'LIKE', "%{$request->input}%")
            ->first();

        $param = [
            'input' => $request->input,
            'item' => $item
        ];
        return view('find', $param);
    }

    // 教材の「ルートバインディング」用メソッド
    public function bind(Author $author)
    {
        $data = [
            'item' => $author,
        ];
        // resources/views/author/binds.blade.php を表示する
        return view('author.binds', $data);
    }
}
