<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',     //　注文ID(FK)
        'user_id',      //　ユーザーID(FK)
        'content',      //　コメント
        'delete_flag'   //　削除フラグ
    ];
    public function order()
    {
        return $this->belongsTo(orders::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
