@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="main__navi">
        <div class="main__navi-list">
            <ul class="main__navi-ul">
                <li class="main__navi-item"><a href="" class="main__navi--recommends">おすすめ</a></li>
                <li class="main__navi-likes"><a href="" class="main__navi--likes">マイリスト</a></li>
            </ul>
        </div>
    </div>
    <div class="main__items-list">
        <ul class="item-grid">
            @foreach($items as $item)
            <li class="item-card">
                <a href="/item/{{ $item->id }}" class="items-detail-link">
                    <img src="{{ asset('storage/' . $item->item_image) }}" width="200" height="200" alt="商品画像">
                    <p class="item-">{{ $item->item_name }}</p>
                    @if($item->buyer_id)
                    <p class="item-status">SOLD</p>
                    @endif
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection