@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/auth.css')}}">
@endsection

@section('content')
<div class="register-form__content">
    <div class="register-form__heading">
        <h2>ログイン</h2>
    </div>
    <div class="form__group">
        <form action="/login" class="form" method="post" novalidate>
            @csrf
            <ul class="form__group-ul">
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
                    <div class="form__group-item-button">
                        <button class="form__button-submit">ログインする</button>
                    </div>
                </li>
            </ul>
        </form>
    </div>
    <div class="transition-login">
        <a href="/register" class="to-login">会員登録はこちら</a>
    </div>
</div>
@endsection