<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Like;
use App\Models\Comment;

class Item extends Model
{
    protected $fillable = [
        'item_image',
        'item_name',
        'brand_name',
        'item_price',
        'seller_id',
        'item_detail',
        'category_id',
        'condition_id',
        'buyer_id',
        'purchase_address',
        'purchase_post_code',
        'purchase_building',
    ];

    public function user(){
    return $this->belongsTo(User::class);
    }

    public function category(){
    return $this->belongsTo(Category::class);
    }

    public function condition(){
    return $this->belongsTo(Condition::class);
    }

    public function likes(){
    return $this->hasMany(Like::class,'like_item_id');
    }

    public function comments(){
    return $this->hasMany(Comment::class);
    }
}

