<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
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

    public function show(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('mypage_profile', compact('user', 'profile'));
    }

    public function store(ProfileRequest $request)
{
    $user = Auth::user();
    
    $profile = $user->profile ?: new Profile(['user_id' => $user->id]);

    $user->user_name = $request->user_name;
    $profile->post_code = $request->post_code;
    $profile->address   = $request->address;
    $profile->building  = $request->building;

    if ($request->hasFile('profile_image')) {
        $path = $request->file('profile_image')->store('images', 'public');
        $profile->profile_image = $path;
    }

    $profile->save();
                
    return redirect()->route('mypage')->with('successMessage', 'プロフィールを更新しました');
}
}
