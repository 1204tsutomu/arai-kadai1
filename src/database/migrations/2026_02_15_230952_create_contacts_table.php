<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            // カテゴリーとの紐付け（重要！）
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            // 名前は「姓」と「名」に分ける
            $table->string('first_name');
            $table->string('last_name');

            // 性別（1:男性, 2:女性, 3:その他）
            $table->tinyInteger('gender');

            $table->string('email');

            // 電話番号は3つに分ける（5桁ずつ入るように）
            $table->string('tel1');
            $table->string('tel2');
            $table->string('tel3');

            $table->string('address');
            $table->string('building_name')->nullable(); // 建物名は任意

            // 教材の'content'ではなく'detail'（お問い合わせ内容）
            $table->text('detail');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
