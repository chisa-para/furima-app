<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Models\Item;

class LikeController extends Controller
{
    public function toggleLike($item_id)
{
    $user = Auth::user();
    $item = Item::findOrFail($item_id);

    $item->likes()->toggle($user->id);

    $likesCount = $item->likes()->count();
    
    $isLiked = $item->likes()->where('like_user_id', $user->id)->exists();

    return response()->json([
        'likesCount' => $likesCount,
        'isLiked' => $isLiked,
    ]);
}
}
