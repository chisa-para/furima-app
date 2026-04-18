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
  
        @if($errors->any())
        <div class="todo__alert--danger" style="color: red; backgraucd: rgb(255, 164, 164);">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="profile-form__heading">
        <h2>プロフィール設定</h2>
    </div>
    <div class="form__group">
        <form action="/mypage/profile/update" class="form" method="" novalidateenctype="multipart/form-data">
            @csrf
            <ul class="form__group-ul">
                <li class="form__group-item">
                    <div class="form__user-img">
                        @if(isset($filename))
                        <img src="{{ asset() }}" style="max-width: 300px;">
                        @else
                        <div style="max-width: 300px;"></div>
                        @endif
                    </div>
                    <img src="" alt="">
                    <input type="file" name="user_image" value="画像を選択">
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
                 @error('address')
                    {{ $message }}
                    @enderror
                <li class="form__group-item">
                    <label for="building">建物名</label>
                    <input type="text" name="building" value="{{ $user->profile->building ?? '' }}"/>
                </li>
                 @error('building')
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