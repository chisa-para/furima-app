<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class PurchaseController extends Controller
{
    public function index($id)
    {
        $item = Item::find($id);
        
        return view('purchase', compact('item'));
    }

    public function show($id)
    {
        $item = Item::findorFail($id);

        return view('purchase_address', compact('item'));
    }

    public function store($id, Request $request)
    {
        $item = Item::findorFail($id);
        
        $updateData = [
        'purchase_post_code' => $request->purchase_post_code,
        'purchase_address'   => $request->purchase_address,
        'purchase_building'  => $request->purchase_building,
        ];

        $item->update($updateData);

        return redirect("/purchase/{$id}");
    }
}
