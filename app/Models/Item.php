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

    public function likes()
{
    return $this->belongsToMany(
        User::class,
        'likes',     
        'like_item_id',
        'like_user_id'  
    )->withTimestamps();
}

    public function comments(){
    return $this->hasMany(Comment::class);
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('item_name', 'like', '%' . $keyword . '%');
            }
            
        return $query;
    }

    public function isLikedBy($user): bool {
    return $user ? $this->likes()->where('like_user_id', $user->id)->exists() : false;
}
}

