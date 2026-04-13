@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')
<div class="purchase__content">
    <div class="content__inner">
        <div class="item-detail">
            <div class="item-info-innner">
                <div class="item-img">
                    <p class="img">商品画像</p>
                </div>
                <div class="item-info">
                    <p class="item-name">商品名</p>
                    <p class="item-price">¥47,000</p>
                </div>
            </div>
            <div class="purchase-info">
                <ul class="purchase-info-ul">
                    <li class="purchase-info-"choice></li>
                    <li class="purchase-info-"choice></li>
                </ul>
            </div>
        </div>
        <div class="item-detail__confirm">
            
        </div>
    </div>
</div>
@endsection