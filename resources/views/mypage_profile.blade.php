@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/mypage.css')}}">
@endsection

@section('content')
<div class="profile-form__content">
    <div class="todo__alert">
        @if(session('successMessage'))
        <div class="todo__alert--success">
            {{session('successMessage')}}
        </div>
        @endif
    </div>
    <div class="profile-form__heading">
        <h2>プロフィール設定</h2>
    </div>
    <div class="form__group">
        <form action="/mypage/profile/update" class="form" method="post" enctype="multipart/form-data">
            @csrf
            <ul class="form__group-ul">
                <li class="form__group-item">
                    <div class="form__user-img">
                        @if(empty($profile->profile_image))
                        <div class="user-img">ユーザー画像</div>
                        @else
                        <img class="main__item-img" src="{{ asset('storage/' . $profile->profile_image) }}" width="200" height="200" alt="ユーザー画像">
                        @endif
                    </div>
                    <input type="file" name="profile_image" value="画像を選択">
                </li>
                <li class="form__group-item">
                    <label for="user_name">ユーザー名</label>
                    <input type="text" id="user_name" name="user_name" value="{{ $user->user_name }}"/>
                </li>
                <div class="form__error">
                   @error('user_name')
                    {{ $message }}
                    @enderror
                </div>
                <li class="form__group-item">
                    <label for="post_code">郵便番号</label>
                    <input type="text" name="post_code" value="{{ $user->profile->post_code ?? '' }}"/>
                </li>
                <div class="form__error">
                    @error('post_code')
                    {{ $message }}
                    @enderror
                </div>
                <li class="form__group-item">
                    <label for="address">住所</label>
                    <input type="text" name="address" value="{{ $user->profile->address ?? '' }}"/>
                </li>
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
                <li class="form__group-item">
                    <label for="building">建物名</label>
                    <input type="text" name="building" value="{{ $user->profile->building ?? '' }}"/>
                </li>
                <li class="form__group-item">
                    <button class="form__button-submit">更新する</button>
                </li>
            </ul>
        </form>
    </div>
</div>
@endsection