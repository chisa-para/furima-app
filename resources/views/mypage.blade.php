@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/mypage.css')}}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="main__user-info">
        @if(empty($profile->profile_image))
        <div class="user-img">ユーザー画像</div>
        @else
        <img class="main__user-img" src="{{ asset('storage/' . $profile->profile_image) }}" width="200" height="200" alt="ユーザー画像">
        @endif
        <p class="user-name">{{ $user->user_name }}</p>
        <a class="profile-edit" href="/mypage/profile" class="profile-edit">プロフィールを編集</a>
    </div>
    <div class="main__navi">
        <div class="main__navi-list">
            <ul class="main__navi-ul">
                <li class="main__navi-item"><a href="{{ route('mypage', ['page' => 'sell']) }}" class="main__navi--recommends">出品した商品</a></li>
                <li class="main__navi-likes"><a href="{{ route('mypage', ['page' => 'buy']) }}" class="main__navi--likes">購入した商品</a></li>
            </ul>
        </div>
    </div>
    <div class="main__items-list">
        <ul class="main__items-ul">
            @foreach($items as $item)
            <li class="main__item-card">
                <img class="main__item-img" src="{{ asset('storage/' . $item->item_image) }}" width="200" height="200" alt="商品画像">
                <p class="main__item-name">{{ $item->item_name }}</p>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection