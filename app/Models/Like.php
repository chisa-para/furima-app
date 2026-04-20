<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Like extends Model
{
    protected $fillable = [
    'like_user_id',
    'like_item_id', 
];
}
