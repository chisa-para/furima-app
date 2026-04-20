<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Category;
use App\Models\Condition;
use App\Http\Requests\CommentRequest;

class ItemController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
        $items = Item::where('seller_id', '!=', Auth::id())->get();
    } else {
        $items = Item::all();
    }

        return view('item', compact('items'));
    }

    public function show($id)
    {
        $item = Item::with(['likes', 'comments.user.profile'])->findOrFail($id);
        
        return view('item_detail', compact('item'));
    }

    public function toggleLike($id)
    {
        $user = Auth::user();
        $item = Item::findOrFail($id);

    // ユーザーがこの商品をいいねしているかチェック
    // likes()リレーションがある前提です
    $like = Like::where('like_item_id', $item_id)->where('user_id', $user->id)->first();

    if ($like) {
        $like->delete();
        $status = 'unliked';
    } else {
        Like::create([
            'user_id' => $user->id,
            'like_item_id' => $item_id, // ここを正しいカラム名に合わせる
        ]);
        $status = 'liked';
    }

    $newCount = Like::where('like_item_id', $item_id)->count();

    return response()->json([
        'status' => $status,
        'count' => $newCount // 最新の数を数える
    ]);
}

    public function exhibit()
    {
        $categories=Category::all();
        $conditions=Condition::all();
        return view('sell', compact('categories', 'conditions'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        exit('ここに来ました');

        $item = $request;
        Item::create([
            'item_image' => $request->item_image,
            'category_id' => $request->category_id,
            'condition_id' => $request->condition_id,
            'item_name' => $request->item_name,
            'brand_name' => $request->brand_name,
            'item_detail' => $request->item_detail,
            'item_price' => $request->item_price,
            'seller_id' => $user->id,
        ]);
        return redirect('/')->with('successMessage','商品を出品しました');
    }

    public function post($id, CommentRequest $request)
    {
        $user = Auth::user();
        
        Comment::create([
            'comment_user_id' => $user->id,
            'item_id' => $id,
            'comment_detail' => $request->comment_detail,
        ]);

        return redirect("/item/{$id}")->with('successMessage','コメントを投稿しました');
    }

    public function search(Request $request)
    {
        $items = Item::select('id','item_name','item_image')->KeywordSearch($request->keyword)->get();

        return view('item', compact('items'));
    }
}
