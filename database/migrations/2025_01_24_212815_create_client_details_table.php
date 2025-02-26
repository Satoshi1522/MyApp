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
    Schema::create('client_details', function (Blueprint $table) {
      $table->id();
      $table->string('client_id')->index();
      $table->string('phone_number'); //電話番号
      $table->string('email'); //Eメール
      $table->string('lastname'); //姓
      $table->string('lastname_furigana'); //姓　フリガナ
      $table->string('name'); //名
      $table->string('name_furigana'); //名　フリガナ
      $table->string('company')->nullable();
      $table->string('postcode'); //郵便番号
      $table->text('prefectures'); //都道府県
      $table->text('town'); //市区町村
      $table->text('building')->nullable();
      $table->string('payment'); //支払い方法
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
    Schema::dropIfExists('client_deteils');
  }
};