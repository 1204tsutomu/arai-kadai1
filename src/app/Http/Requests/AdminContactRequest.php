<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // ここを忘れると403エラーになるので注意！
    }

    public function rules()
    {
        return [
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255',
            'detail' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required'   => '管理用：お名前の入力は必須です。',
            'email.required'  => 'メールアドレスを入力してください。',
            'email.email'     => '正しいメール形式で入力してください。',
            'detail.required' => '詳細内容を入力してください。',
        ];
    }
}
