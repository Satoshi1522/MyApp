<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRegister extends Model
{
  use HasFactory;
  protected $fillable = [
    'name',         //　商品名
    'explanation',  //　商品説明
    'image',        //　商品画像
    'value',        //　税抜き価格
    'stock',        //　在庫
    'status',       //　販売ステータス
    'delete_flag'   //　削除フラグ
  ];
  public function comments()
  {
    return $this->hasMany(ItemComments::class);
  }
}
