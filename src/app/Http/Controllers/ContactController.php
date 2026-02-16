<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        // ここでDBからカテゴリーを取って、ビューに渡しています
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building_name',
            'category_id',
            'detail'
        ]);

        $category = Category::find($request->category_id);
        $contact['category_content'] = $category ? $category->content : '';

        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        return view('thanks');
    }
}
