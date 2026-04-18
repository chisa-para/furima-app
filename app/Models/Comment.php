<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment_user_id',
        'item_id',
        'comment_detail',
    ];

    public function user(){
    return $this->belongsTo(User::class, 'comment_user_id');
    }
}
