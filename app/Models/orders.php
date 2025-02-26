<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
  use HasFactory;
  protected $fillable = [
    'client_id',     //　顧客ID(FK)
    'total_amount',  //　合計金額
    'status',        //　配送状況
    'pay_status',    //　入金状況
    'cancel_flag'    //　キャンセルフラグ
];
  public function client_deteil(){
    return $this->belongsTo(Client_detail::class,'client_id','client_id');
  }
  public function orderItems(){
    return $this->hasManyThrough(order_items::class, orders::class,'client_id', 'order_id', 'client_id', 'id');
  }
}