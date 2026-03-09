<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required'   => 'お名前の入力は必須です。',
            'email.required'  => 'メールアドレスも必須です。',
            'email.email'     => '正しいメール形式で入力してください。',
            'password.required' => '必須事項です',
            'password.string' => '英数記号で入力してください',
        ];
    }
}
