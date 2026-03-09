<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    // 18行目〜30行目を消して、これだけにする
    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        $contact['building_name'] = $request->building;

        // ★ 画像アップロード処理を追加
        if ($request->hasFile('image_file')) {
            // 画像を storage/app/public/img に保存し、そのパスを取得
            $path = $request->file('image_file')->store('img', 'public');
            // ファイル名（パス）を $contact 配列にセット
            $contact['image_file'] = $path;
        }

        $category = Category::find($request->category_id);
        $contact['category_content'] = $category ? $category->content : '';

        return view('confirm', compact('contact'));
    }

    public function store(Request $request)
    {
        // 修正ポイント：$request->all() には image_file（パス文字列）が含まれているのでそのまま保存可能
        Contact::create($request->all());

        return view('thanks');
    }


    public function admin()
    {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }
}
