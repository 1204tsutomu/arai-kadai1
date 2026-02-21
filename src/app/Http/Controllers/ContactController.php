<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    // 1. 入力画面の表示
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    // 2. 確認画面の表示
    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();

        if (!isset($contact['building_name'])) {
            $contact['building_name'] = '';
        }

        $category = Category::find($request->category_id);
        $contact['category_content'] = $category ? $category->content : '';

        return view('confirm', compact('contact'));
    }

    // 3. 保存処理
    public function store(Request $request)
    {
        // 修正ポイント: 実際に保存する場合はコメントアウトを外します
        // Contact::create($request->all());
        return view('thanks');
    }

    // ★追加: 管理画面の表示 (ページネーション実装)
    public function admin()
    {
        // paginateメソッドで1ページに表示する数（例: 7件）を指定します
        // 表示する項目だけでなく、リンク生成機能も含まれます
        $contacts = Contact::with('category')->paginate(7);

        // 検索用などにカテゴリー一覧も渡しておくと便利です
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
}
