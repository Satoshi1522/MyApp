<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_registers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20); //商品名
            $table->string('explanation', 50); //商品説明
            $table->string('image', 50); //商品画像
            $table->integer('value'); //税抜き価格
            $table->integer('stock'); //在庫
            $table->boolean('status'); // 販売ステータス
            $table->boolean('delete_flag'); // 削除フラグ
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
        Schema::dropIfExists('item_registers');
    }
};
