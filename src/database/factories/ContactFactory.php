<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            // categoriesテーブルのIDをランダムに割り当て
            'category_id' => Category::inRandomOrder()->first()->id,

            // 名前を姓と名に分けて生成
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,

            // 性別（1:男性, 2:女性, 3:その他）
            'gender' => $this->faker->numberBetween(1, 3),

            'email' => $this->faker->safeEmail,

            // 電話番号を3分割（例: 090-1234-5678）
            'tel' => $this->faker->numerify('###########'),

            'address' => $this->faker->address,
            'building_name' => $this->faker->secondaryAddress, // 建物名（任意）

            // お問い合わせ内容
            'detail' => $this->faker->realText(100),
        ];
    }
}
