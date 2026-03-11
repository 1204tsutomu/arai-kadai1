<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Channel;

class ContactController extends Controller
{
    public function index()
    {
        // 1. 全ての「きっかけ」データを取得
        $channels = Channel::all();

        // 2. ★追加：全ての「カテゴリー」データを取得
        $categories = Category::all();

        // 3. 両方の変数をviewに渡す
        return view('index', compact('channels', 'categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        $contact['building_name'] = $request->building;

        // ★ 追加：選択されたchannel_idsから、表示用のデータを取得
        $channels = Channel::find($request->channel_ids);
        $contact['channels'] = $channels;

        // 画像アップロード処理（既存）
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('img', 'public');
            $contact['image_file'] = $path;
        }

        $category = Category::find($request->category_id);
        $contact['category_content'] = $category ? $category->content : '';

        // $channels も一緒にViewに渡す
        return view('confirm', compact('contact', 'channels'));
    }

    public function store(Request $request)
    {
        // 1. 問い合わせ基本情報を保存（戻り値として保存した$contactを受け取る）
        $contact = Contact::create($request->all());

        // 2. ★ 追加：中間テーブルに「きっかけ」を保存
        if ($request->has('channel_ids')) {
            $contact->channels()->sync($request->channel_ids);
        }

        return view('thanks');
    }
    public function admin()
    {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }
}
