@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')
<div class="item-detail__content">
    <div class="content__inner">
        <div class="item-detail__img">
            <div class="detail__img">
                <img src="{{ asset('storage/images/' . $item->item_image) }}" width="300" height="300" alt="商品画像">
            </div>
        </div>
        <div class="item-detail__content">
            <ul class="item-detail__ul">
                <li class="item-detail__main-info">
                    <h2 class="item-detail__name">{{ $item->item_name }}</h2>
                    <p class="item-detail__brand">{{ $item->brand_name }}</p>
                    <p class="item-detail__price">¥{{ $item->item_price }}<span>（税込）</span></p>
                    <div class="item-detail__icons">
                        <img src="{{ asset('images/ハートロゴ_デフォルト.png') }}"alt="いいね数">
                        <p class="likes">{{ $item->likes->count() }}</p>
                        <img src="{{ asset('images/ふきだしロゴ.png') }}" alt="コメント数">
                        <p class="comments">{{ $item->comments->count() }}</p>
                    </div>
                </li>
                <a href="/purchase/item" class="purchase-process">購入手続きへ</a>
                <li class="item-detail__explain">
                    <h3 class="item-detail__explain">商品説明</h3>
                    <p class="item-detail__explain">{{ $item->item_detail }}</p>
                </li>
                <li class="item-detail__add-info">
                    <h3 class="detail__add-info">商品の情報</h3>
                    <ul class="add-info">
                        <li class="add-info__li">
                            <p class="add-info__ttl">カテゴリー</p>
                            <p class="add-info__category">{{ $item->category->category_content }}</p>
                        </li>
                        <li class="add-info__li">
                            <p class="add-info__ttl">商品の状態</p>
                            <p class="add-info__condition">{{ $item->condition->condition_content }}</p>
                        </li>
                    </ul>
                </li>
                <li class="item-detail__comment">
                    <h3 class="detail__comments">コメント({{ $item->comments->count() }})</h3>
                    @foreach($item->comments as $comment)
                    <div class="comment-info">
                        <div class="img"></div>
                        <p class="user_name">admin</p>
                    </div>
                    <p class="comment">{{ $comment->comment_detail }}</p>
                    @endforeach
                    <h4 class="detail__send-comment">商品へのコメント</h4>
                    <form action="">
                        <input type="text">
                        <button>コメントを送信する</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection