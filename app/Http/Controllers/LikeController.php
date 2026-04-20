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

    // すでにいいねしていたら解除、してなければ登録（toggle）
    // ※Userモデルに likes() リレーション（belongsToMany）がある前提です
    $item->likes()->toggle($user->id);

    // 最新のいいね数を取得
    $likesCount = $item->likes()->count();
    // 自分がいいねしたかどうかの判定
    $isLiked = $item->likes()->where('like_user_id', $user->id)->exists();

    return response()->json([
        'likesCount' => $likesCount,
        'isLiked' => $isLiked,
    ]);
}
}
