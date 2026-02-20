<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. まず親となるカテゴリーを作成する
        DB::table('categories')->insert([
            'id' => 1,
            'content' => '商品に関するお問い合わせ', // カラム名はマイグレーションに合わせてください
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. その後で contacts（子）を作成する
        $param = [
            'last_name'   => '山田',
            'first_name'  => '太郎',
            'gender'      => 1,
            'email'       => 'test@example.com',
            'tel1'        => '080',
            'tel2'        => '1111',
            'tel3'        => '2222',
            'address'     => '東京都渋谷区千駄ヶ谷1-2-3',
            'category_id' => 1, // ここで指定した 1 が、上のカテゴリー ID と一致する
            'detail'      => '商品に関する問い合わせです。',
        ];
        DB::table('contacts')->insert($param);
    }
}
