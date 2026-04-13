@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/mypage.css')}}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="main__user-img">
        <div class="user-img">ユーザー写真</div>
        <p class="user-name">ユーザー名</p>
        <a href="" class="profile-edit">プロフィールを編集</a>
        <edit></edit>
    </div>
    <div class="main__navi">
        <div class="main__navi-list">
            <ul class="main__navi-ul">
                <li class="main__navi-item"><a href="" class="main__navi--recommends">出品した商品</a></li>
                <li class="main__navi-likes"><a href="" class="main__navi--likes">購入した商品</a></li>
            </ul>
        </div>
    </div>
    <div class="main__items-list">
        <div class="main__item">
            <a href="/item/detail/" class="items-detail">
                <div class="item-img">商品画像</div>
                <p>商品名</p>
            </a>
        </div>
    </div>
</div>
@endsection