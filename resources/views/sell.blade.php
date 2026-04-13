@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/sell.css')}}">
@endsection

@section('content')
<div class="sell-form__content">
    <div class="sell-form__heading">
        <h2>商品の出品</h2>
    </div>
    <div class="sell-form__group">
        <form action="" class="sell-form" method="post" novalidate>
            @csrf
            <ul class="sell-item-info__ul">
                <li class="sell-item-info__img">
                    <label>商品画像</label>
                    <input type="file" name="item_image" value="画像を選択">
                </li>
                <div class="form__error">
                   @error('purchase_post_code')
                    {{ $message }}
                    @enderror
                </div>
                <li class="sell-item-info__detail">
                    商品の詳細
                    <ul class="item-info__detail-ul">
                        <li class="detail__category">
                            <label>カテゴリー
                            </label>
                            <input type="checkbox">
                        </li>
                        <div class="form__error">
                            @error('detail__category')
                            {{ $message }}
                            @enderror
                        </div>
                        <li class="detail__condition">
                            <label>商品の詳細
                            </label>
                            <select name="" id="">
                                <option value="1">新品同様</option>
                            </select>
                        </li>
                        <div class="form__error">
                            @error('detail__condition')
                            {{ $message }}
                            @enderror
                        </div>
                    </ul>
                </li>
                <li class="sell-item-info__intro">
                    商品名と説明
                    <ul class="item-info__intro-ul">
                        <li class="intro__detail">
                            <label for="item_name">商品名
                            </label>
                            <input type="text" class="item_name">
                        </li>
                        <div class="form__error">
                            @error('')
                            {{ $message }}
                            @enderror
                        </div>
                        <li class="intro__detail">
                            <label for="item_brand">ブランド名
                            </label>
                            <input type="text" class="item_brand">
                        </li>
                        <div class="form__error">
                            @error('')
                            {{ $message }}
                            @enderror
                        </div>
                        <li class="intro__detail">
                            <label for="item_detail">商品の説明
                            </label>
                            <input type="text" class="item_detail">
                        </li>
                        <div class="form__error">
                            @error('')
                            {{ $message }}
                            @enderror
                        </div>
                        <li class="intro__detail">
                            <label for="item_price">販売価格
                            </label>
                            <input type="text" class="item_price">
                        </li>
                        <div class="form__error">
                            @error('')
                            {{ $message }}
                            @enderror
                        </div>
                    </ul>
                </li>
                <li class="form__group-item">
                    <button class="form__button-submit">出品する</button>
                </li>
            </ul>
        </form>
    </div>
</div>
@endsection