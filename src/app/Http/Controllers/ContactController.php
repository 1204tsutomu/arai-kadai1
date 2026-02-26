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

        $category = Category::find($request->category_id);
        $contact['category_content'] = $category ? $category->content : '';

        return view('confirm', compact('contact'));
    }
    // 修正前：public function confirm(ContactRequest $request)
    // --- 以下の store メソッドを admin の上あたりに追加してください ---
    public function store(Request $request)
    {
        // building_name など、hiddenで送られたデータを丸ごと保存
        Contact::create($request->all());

        // 保存が終わったらサンクス画面へ
        return view('thanks');
    }


    public function admin()
    {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }
}
