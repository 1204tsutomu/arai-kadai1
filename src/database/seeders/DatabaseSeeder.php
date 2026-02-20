<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DB操作に必要
use App\Models\Contact;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. categoriesテーブルの作成 (画像の内容)
        $category_names = [
            '商品のお届けについて',
            '商品の交換について',
            '商品トラブル',
            'ショップへのお問い合わせ',
            'その他'
        ];

        foreach ($category_names as $name) {
            Category::create([
                'content' => $name
            ]);
        }

        // 2. contactsテーブルに35件作成 (ファクトリ機能を利用)
        // もし専用のFactoryファイルがない場合は、モデルのfactory()が
        // デフォルトのFakerを利用して動くよう、ここでループを回します
        Contact::factory()->count(35)->create([
            // category_idをランダムに割り当てるための処理
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            }
        ]);
    }
}
