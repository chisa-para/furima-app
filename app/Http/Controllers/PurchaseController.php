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

    public function checkout($id, PurchaseRequest $request)
{
    $item = Item::findOrFail($id);
    session([
        'tmp_post_code' => $request->purchase_post_code,
        'tmp_address' => $request->purchase_address,
        'tmp_building' => $request->purchase_building,
        ]);

        
    // ログイン中のユーザーをStripeの決済ページへリダイレクト
    return $request->user()->checkoutCharge($item->item_price, $item->item_name, 1, [
        'success_url' => route('checkout-success', ['item_id' => $id]),
        'cancel_url' => route('checkout-cancel', ['item_id' => $id]),
        
    ]);
}

    public function success($id, Request $request)
{
    
    $user = Auth::user();
    $item = Item::findOrFail($id);

    $item->update([
        'purchase_post_code' => session('tmp_post_code'),
        'purchase_address'   => session('tmp_address'),
        'purchase_building'  => session('tmp_building'),
        'buyer_id'           => $user->id               
    ]);

    session()->forget(['tmp_post_code', 'tmp_address', 'tmp_building']);

    return redirect('/')->with('successMessage', '購入が完了しました');
}

public function cancel($id)
{
    return redirect("/purchase/{$id}"); // 「決済がキャンセルされました」画面
}
}
