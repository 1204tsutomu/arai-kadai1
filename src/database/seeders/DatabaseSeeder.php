<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. 外部キー制約を一時的に無効化（truncate時のエラー防止）
        Schema::disableForeignKeyConstraints();

        // 2. 既存データの削除
        Category::truncate();
        Contact::truncate();

        // 外部キー制約を元に戻す
        Schema::enableForeignKeyConstraints();

        // 3. Categoryデータの作成
        $categories = [
            ['content' => '商品のお届けについて'],
            ['content' => '商品の交換について'],
            ['content' => '商品トラブル'],
            ['content' => 'ショップへのお問い合わせ'],
            ['content' => 'その他'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // 4. Contactデータの作成 (35件)
        // category_idをランダムに割り当てる
        Contact::factory()->count(35)->create([
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            }
        ]);
    }
}
