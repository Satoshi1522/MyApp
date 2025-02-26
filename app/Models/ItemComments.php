<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemComments extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',    //　商品ID(FK)
        'user_id',    //　ユーザーID(FK)
        'content',    //　コメント
        'delete_flag' //　削除フラグ
    ];
    public function item()
    {
        return $this->belongsTo(ItemRegister::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
