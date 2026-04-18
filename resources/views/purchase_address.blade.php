@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/auth.css')}}">
@endsection

@section('content')
<div class="register-form__content">
    <div class="register-form__heading">
        <h2>住所変更</h2>
    </div>
    <div class="form__group">
        <form action="/purchase/address/{{ $item->id }}/update" class="form" method="" novalidate>
            @csrf
            <ul class="form__group-ul">
                <li class="form__group-item">
                    <label for="purchase_post_code">郵便番号</label>
                    <input type="text" id="purchase_post_code" name="purchase_post_code" value="{{ $item->purchase_post_code }}"/>
                </li>
                <div class="form__error">
                   @error('purchase_post_code')
                    {{ $message }}
                    @enderror
                </div>
                <li class="form__group-item">
                    <label for="purchase_address">住所</label>
                    <input type="text" id="purchase_address" name="purchase_address" value="{{ $item->purchase_address }}"/>
                </li>
                <div class="form__error">
                    @error('purchase_address')
                    {{ $message }}
                    @enderror
                </div>
                <li class="form__group-item">
                    <label for="purchase_building">建物名</label>
                    <input type="text" id="purchase_building" name="purchase_building" value="{{ $item->purchase_building }}"/>
                </li>
                 @error('purchase_building')
                    {{ $message }}
                    @enderror
                <li class="form__group-item">
                    <button class="form__button-submit">更新する</button>
                </li>
            </ul>
        </form>
    </div>
</div>
@endsection