@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')
<div class="item-detail__content">
    <div class="content__inner">
        <div class="item-detail__img">
            <div class="detail__img">
                <img src="{{ asset('storage/' . $item->item_image) }}" width="300" height="300" alt="商品画像">
            </div>
        </div>
        <div class="item-detail__content">
            <ul class="item-detail__ul">
                <li class="item-detail__main-info">
                    <h2 class="item-detail__name">{{ $item->item_name }}</h2>
                    <p class="item-detail__brand">{{ $item->brand_name }}</p>
                    <p class="item-detail__price">¥{{ $item->item_price }}<span>（税込）</span></p>
                    <div class="item-detail__icons">
                        <button id="like-button" data-item-id="{{ $item->id }}" style="border: none; background: none; cursor: pointer;">
                            @if($item->isLikedBy(Auth::user())) {{-- モデルに判定メソッドを作っておくと楽です --}}
                            <img src="{{ asset('images/ハートロゴ_ピンク.png') }}" id="heart-icon" width="30">
                            @else
                            <img src="{{ asset('images/ハートロゴ_デフォルト.png') }}" id="heart-icon" width="30">
                            @endif
                        </button>
                        <span id="like-count">{{ $item->likes()->count() }}</span>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <img src="{{ asset('images/ふきだしロゴ.png') }}" alt="コメント数">
                        <p class="comments">{{ $item->comments->count() }}</p>
                    </div>
                </li>
                <a href="/purchase/{{ $item->id }}" class="purchase-process">購入手続きへ</a>
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
                        @if(empty($profile->profile_image))
                        <div class="user-img">ユーザー画像</div>
                        @else
                        <img class="main__item-img" src="{{ asset('storage/images/' . $comment->user->profile->profile_image) }}" width="200" height="200" alt="ユーザー画像">
                        @endif
                        <p class="user_name">{{ $comment->user->user_name }}</p>
                    </div>
                    <p class="comment">{{ $comment->comment_detail }}</p>
                    @endforeach
                    <h4 class="detail__send-comment">商品へのコメント</h4>
                    <form action="/item/{{ $item->id }}/comment" method="post">
                        <input name="comment_detail" type="text">
                        <div class="form__error">
                            @error('comment_detail')
                            {{ $message }}
                            @enderror
                        </div>
                        <button>コメントを送信する</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
    document.getElementById('like-button').addEventListener('click', function() {
    const itemId = this.dataset.itemId;
    const heartIcon = document.getElementById('heart-icon');
    const likeCount = document.getElementById('like-count');

    fetch(`/items/${itemId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        // 1. カウントを更新
        likeCount.innerText = data.likesCount;

        // 2. ハートの画像を切り替える
        if (data.isLiked) {
            heartIcon.src = "/images/ハートロゴ_ピンク.png"; // いいね済みの画像パス
        } else {
            heartIcon.src = "/images/ハートロゴ_デフォルト.png"; // 未いいねの画像パス
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>
@endsection