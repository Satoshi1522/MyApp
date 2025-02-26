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
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->string('client_id');
      $table->foreign('client_id')->references('client_id')->on('client_details')->onDelete('cascade');
      $table->decimal('total_amount', 10, 2);
      $table->boolean('status'); // 配送フラグ
      $table->boolean('cancel_flag'); // キャンセルフラグ
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
    Schema::dropIfExists('orders');
  }
};
