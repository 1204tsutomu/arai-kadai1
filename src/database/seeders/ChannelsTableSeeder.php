<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChannelsTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'content' => '自社サイト',
        ];
        DB::table('channels')->insert($param);
        $param = [
            'content' => '検索エンジン',
        ];
        DB::table('channels')->insert($param);
        $param = [
            'content' => 'SNS',
        ];
        DB::table('channels')->insert($param);
        $param = [
            'content' => 'テレビ・新聞',
        ];
        DB::table('channels')->insert($param);
        $param = [
            'content' => '友人・知人',
        ];
        DB::table('channels')->insert($param);
    }
}
