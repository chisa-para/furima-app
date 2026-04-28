<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Models\Item;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;

class PurchaseController extends Controller
{
    public function index($id)
    {
        $user = Auth::user();
        $item = Item::find($id);
        
        return view('purchase', compact('user','item'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $profile = $user->profile;
        $item = Item::findorFail($id);

        return view('purchase_address', compact('user','profile','item'));
    }

    public function confirm($id, AddressRequest $request)
    {
        session([
            'address_updates' => [
                'purchase_post_code' => $request->purchase_post_code,
                'purchase_address'   => $request->purchase_address,
                'purchase_building'  => $request->purchase_building,
            ]
        ]);

        return redirect("/purchase/{$id}");
    }

    public function store($id, PurchaseRequest $request)
{
    $user = Auth::user();
    $item = Item::findOrFail($id);

    $item->update([
        'purchase_post_code' => $request->purchase_post_code,
        'purchase_address'   => $request->purchase_address,
        'purchase_building'  => $request->purchase_building,
        'payment_method'     => $request->payment_method,
        'buyer_id'           => $user->id               
    ]);

    session()->forget('address_updates');

    return redirect('/')->with('successMessage', '購入が完了しました');
}
}
