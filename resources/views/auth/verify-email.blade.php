@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/auth.css')}}">
@endsection

@section('content')
<div class="mail__content">
    <div class="mail__text">
        @if (session('status') == 'verification-link-sent')
        <div style="color: green;">
            新しい認証リンクをメールアドレスに送信しました！
        </div>
        @endif
        <p>ログイン</p>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">認証メールを再送する</button>
        </form>
    </div>
</div>
@endsection