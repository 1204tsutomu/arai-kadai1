<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * バリデーション前にデータを加工する
     */
    protected function prepareForValidation()
    {
        // tel1, tel2, tel3 が存在する場合のみ合体させて 'tel' を作成
        $this->merge([
            'tel' => $this->tel1 . $this->tel2 . $this->tel3,
        ]);
    }
    public function rules()
    {
        return [
            'first_name'  => ['required', 'string', 'max:8'],
            'last_name'   => ['required', 'string', 'max:8'],
            'gender'      => ['required'],
            'email'       => ['required', 'string', 'email', 'max:255'],
            // 合体後の 'tel' に対してバリデーションをかける
            'tel'         => ['required', 'numeric', 'digits_between:10,11'],
            'address'     => ['required', 'string', 'max:255'],
            'category_id' => ['required'],
            'detail'      => ['required', 'string', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'last_name.required'  => '姓を入力してください', // 山田
            'last_name.max'       => '姓を8文字以下で入力してください',
            'first_name.required' => '名を入力してください', // 太郎
            'first_name.max'      => '名を8文字以下で入力してください',
            'gender.required'     => '性別を選択してください',
            'email.required'      => 'メールアドレスを入力してください',
            'email.email'         => '有効なメールアドレス形式を入力してください',
            'tel.required'        => '電話番号を入力してください',
            'tel.numeric'         => '電話番号を数値で入力してください',
            'tel.digits_between'  => '電話番号を10桁から11桁の間で入力してください',
            'address.required'    => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required'     => 'お問い合わせ内容を入力してください',
            'detail.max'          => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
