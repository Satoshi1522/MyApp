<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_items extends Model
{
  use HasFactory;
  protected $fillable = [
    'order_id',     //　注文ID(FK)
    'item_id',      //　商品ID(FK)
    'quantity',     //　個数
    'value',        //　商品ごとの合計価格
    'subtotal'      //　全ての合計金額
];
  public function order(){
    return $this->belongsTo(orders::class);
  }
  public function item(){
    return $this->belongsTo(ItemRegister::class,'item_id');
  }
}