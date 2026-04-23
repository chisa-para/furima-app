@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')
<div class="item-__content">
    <div class="content__inner">
        <div class="item-detail__img">
            <div class="detail__img">
                <img src="{{ asset('storage/' . $item->item_image) }}" width="600" height="600" alt="商品画像">
            </div>
        </div>
        <div class="item-detail__content">
            <ul class="item-detail__ul">
                <li class="item-detail__main-info">
                    <h2 class="item-detail__name">{{ $item->item_name }}</h2>
                    <p class="item-detail__brand">{{ $item->brand_name }}</p>
                    <p class="item-detail__price">¥{{ $item->item_price }}<span>（税込）</span></p>
                    <div class="item-detail__icons">
                        <div class="heart">
                            <button id="like-button" data-item-id="{{ $item->id }}" style="border: none; background: none; cursor: pointer;">
                                @if($item->isLikedBy(Auth::user())) {{-- モデルに判定メソッドを作っておくと楽です --}}
                                <img src="{{ asset('images/ハートロゴ_ピンク.png') }}" id="heart-icon" width="43">
                                @else
                                <img src="{{ asset('images/ハートロゴ_デフォルト.png') }}" id="heart-icon" width="43">
                                @endif
                            </button>
                            <p class="counts" id="like-count">{{ $item->likes()->count() }}</p>
                            <meta name="csrf-token" content="{{ csrf_token() }}" width="50">
                        </div>
                        <div class="comment">
                            <img src="{{ asset('images/ふきだしロゴ.png') }}" alt="コメント数">
                            <p class="counts">{{ $item->comments->count() }}</p>
                        </div>
                    </div>
                </li>
                <div class="purchase-process">
                    <a href="/purchase/{{ $item->id }}" class="purchase-button">購入手続きへ</a>
                </div>
                <li class="item-detail__li">
                    <h3 class="item-detail__explain">商品説明</h3>
                    <p class="item-detail__explain-detail">{{ $item->item_detail }}</p>
                </li>
                <li class="item-detail__li">
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
                    <div class="comment__user-info">
                        @foreach($item->comments as $comment)
                        <div class="comment-info">
                            @if(empty($comment->user->profile->profile_image))
                            <div class="user-img">ユーザー画像</div>
                            @else
                            <img class="main__item-img" src="{{ asset('storage/' . $comment->user->profile->profile_image) }}" width="60" height="60" alt="ユーザー画像">
                            @endif
                            <p class="user_name">{{ $comment->user->user_name }}</p>
                        </div>
                        <p class="item_comment">{{ $comment->comment_detail }}</p>
                        @endforeach
                    </div>
                    <h4 class="detail__send-comment">商品へのコメント</h4>
                    <form action="/item/{{ $item->id }}/comment" method="post">
                        <textarea class="comment_detail" name="comment_detail" rows="10">{{ old('comment_detail') }}</textarea>
                        <div class="form__error">
                            @error('comment_detail')
                            {{ $message }}
                            @enderror
                        </div>
                        <button class="send-commentーbutton">コメントを送信する</button>
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

            likeCount.innerText = data.likesCount;

            if (data.isLiked) {
                heartIcon.src = "/images/ハートロゴ_ピンク.png";
            } else {
                heartIcon.src = "/images/ハートロゴ_デフォルト.png";
            }
        })

        .catch(error => console.error('Error:', error));
    });
</script>

@endsection