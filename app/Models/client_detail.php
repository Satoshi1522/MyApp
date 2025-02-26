<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client_detail extends Model
{
  use HasFactory;
  protected $fillable = [
    'client_id',         //　顧客ID
    'phone_number',      //　電話番号
    'email',             //　メールアドレス
    'lastname',          //　姓
    'lastname_furigana', //　姓のフリガナ
    'name',              //　名
    'name_furigana',     //　名のフリガナ
    'company',           //　会社名(任意)
    'status',            //　発送状態
    'postcode',          //　郵便番号
    'prefectures',       //　県名
    'town',              //　市区町村
    'building',          //　建物名(任意)
    'payment',           //　支払い方法
];
  public function orders(){
    return $this->hasOne(orders::class,'client_id','client_id');
  }
}