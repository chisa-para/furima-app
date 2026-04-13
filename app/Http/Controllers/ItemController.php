<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Like;

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
        $item = Item::with(['comments', 'likes'])->findOrFail($id);
        
        return view('item_detail', compact('item'));
    }
}
