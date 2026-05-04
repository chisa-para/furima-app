@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/sell.css')}}">
@endsection

@section('content')
<div class="sell-form__content">
    <div class="sell-form__heading">
        <h2 class="heading2">商品の出品</h2>
    </div>
    <div class="sell-form__group">
        <form action="/items" class="sell-form" method="post" enctype="multipart/form-data">
            @csrf
            <ul class="form__group-ul">
                <li class="form__group-list">
                    <p class="img-ttl">商品画像</p>
                    <div class="form__item-img">
                        <label for="item_image" class="img-label">画像を選択する</label>
                        <input type="file" id="item_image" name="item_image" style="display:none;" />
                    </div>
                </li>
                <div class="form__error">
                   @error('item_image')
                    {{ $message }}
                    @enderror
                </div>
                <li class="form__group-list">
                    <h3 class="heading3">商品の詳細</h3>
                    <ul class="item-info__detail-ul">
                        <li class="detail__list">
                            カテゴリー
                            @foreach($categories as $category)
                            <input type="checkbox" id="{{ $category->category_content }}" name="category_id[]"  value="{{ $category->id }}" class="category-hidden">
                            <label for="{{ $category->category_content }}" class="category-button">{{ $category->category_content }}</label>
                            @endforeach
                        </li>
                        <div class="form__error">
                            @error('category_id')
                            {{ $message }}
                            @enderror
                        </div>
                        <li class="detail__list">
                            商品の状態
                            <select name="condition_id" id="" class="detail__input">
                                <option value="" disabled selected>選択してください</option>
                                @foreach($conditions as $condition)
                                <option value="{{ $condition->id }}">{{ $condition->condition_content }}</option>
                                @endforeach
                            </select>
                        </li>
                        <div class="form__error">
                            @error('condition_id')
                            {{ $message }}
                            @enderror
                        </div>
                    </ul>
                </li>
                <li class="form__group-list">
                    <h3 class="heading3">商品名と説明</h3>
                    <ul class="item-info__detail-ul">
                        <li class="detail__list">
                            <label for="item_name" class="detail__label">商品名
                            </label>
                            <input type="text" id="item_name" name="item_name" class="detail__input" value="{{ old('item_name') }}">
                        </li>
                        <div class="form__error">
                            @error('item_name')
                            {{ $message }}
                            @enderror
                        </div>
                        <li class="detail__list">
                            <label for="item_brand" class="detail__label">ブランド名
                            </label>
                            <input type="text" id="item_brand" name="brand_name" class="detail__input" class="item_brand" value="{{ old('brand_name') }}">
                        </li>
                        <li class="detail__list">
                            <label for="item_detail" class="detail__label">商品の説明
                            </label>
                            <input type="textarea" id="item_detail" name="item_detail" class="detail__input" rows="10" value="{{ old('item_detail') }}">
                        </li>
                        <div class="form__error">
                            @error('item_detail')
                            {{ $message }}
                            @enderror
                        </div>
                        <li class="detail__list">
                            <label for="item_price" class="detail__label">販売価格
                            </label>
                            <input type="text" id="item_price" name="item_price" class="detail__input" value="{{ old('item_price') }}">
                        </li>
                        <div class="form__error">
                            @error('item_price')
                            {{ $message }}
                            @enderror
                        </div>
                    </ul>
                </li>
                <li class="form__group-list">
                    <div class="form__group-item-button">
                        <button class="form__button-submit">出品する</button>
                    </div>
                </li>
            </ul>
        </form>
    </div>
</div>
@endsection