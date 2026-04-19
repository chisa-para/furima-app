<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;
        $page = $request->query('page', 'sell'); 

        if ($page === 'buy') {
        
        $items = Item::where('buyer_id', $user->id)->get(); 
        } else {
        
        $items = Item::where('seller_id', $user->id)->get();
        }

        return view('mypage', compact('user','items', 'profile', 'page'));

    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('mypage_profile', compact('user', 'profile'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id], 
            [
                'user_name' => $request->user_name,
                'profile_image' => $request->profile_image,
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building' => $request->building,
            ]
            );
                
        return redirect()->route('mypage')->with('successMessage', 'プロフィールを更新しました');
    }
}
