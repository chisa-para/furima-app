@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/auth.css')}}">
@endsection

@section('content')
<div class="register-form__content">
    <div class="register-form__heading">
        <h2>会員登録</h2>
    </div>
    <div class="form__group">
        <form action="/register" class="form" method="post" novalidate>
            @csrf
            <ul class="form__group-ul">
                <li class="form__group-item">
                    <label class="form__item-label" for="user_name">お名前</label>
                    <input class="form__item" type="text" id="user_name" name="user_name" value="{{ old('user_name') }}"/>
                </li>
                <div class="form__error">
                   @error('user_name')
                    {{ $message }}
                    @enderror
                </div>
                <li class="form__group-item">
                    <label class="form__item-label" for="email">メールアドレス</label>
                    <input class="form__item" type="text" id="email" name="email" value="{{ old('email') }}"/>
                </li>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
                <li class="form__group-item">
                    <label class="form__item-label" for="password">パスワード</label>
                    <input class="form__item" type="password" id="password" name="password" value="{{ old('password') }}"/>
                </li>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
                <li class="form__group-item">
                    <label class="form__item-label" for="password_confirmation">確認用パスワード</label>
                    <input class="form__item" type="text" id="password_confirmation" name="password_confirmation" value="{{ old('password') }}"/>
                </li>
                 <div class="form__error">
                    @error('password_confirmation')
                    {{ $message }}
                    @enderror
                </div>
                <li class="form__group-item">
                    <div class="form__group-item-button">
                        <button class="form__button-submit">登録</button>
                    </div>
                </li>
            </ul>
        </form>
    </div>
    <div class="transition-login">
        <a href="/login" class="to-login">ログインはこちら</a>
    </div>
</div>
@endsection