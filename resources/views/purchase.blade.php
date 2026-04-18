@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/purchase.css')}}">
@endsection

@section('content')
<div class="purchase__content">
    <div class="content__inner">
        <div class="item-detail">
            <div class="item-detail-info">
                <div class="item-img">
                    <img src="{{ asset('storage/images/' . $item->item_image) }}" width="300" height="300" alt="商品画像">
                </div>
                <div class="item-info">
                    <h2 class="item-name">{{ $item->item_name }}</h2>
                    <p class="item-price">¥{{ $item->item_price }}</p>
                </div>
            </div>
            <div class="payment-method">
                <form action="" class="payment-method__form">
                    <label for="payment-select" class="payment-method__label">支払方法</label>
                    <select name="payment_method" id="payment-select" class="payment-method__select">
                        <option value="コンビニ支払い">コンビニ支払い</option>
                        <option value="カード支払い">カード支払い</option>
                    </select>
                </form>
            </div>
            <div class="shipping-address">
                <h3 class="shipping-address__ttl">配送先</h3>
                <a href="/purchase/address/{{ $item->id }}" class="shipping-address__link">配送先を変更する</a>
                <div class="shipping-address__content">
                    <p class="post-code">〒{{ $item->purchase_post_code }}</p>
                    <p class="address">{{ $item->purchase_address }}</p>
                </div>
            </div>
        </div>
        <div class="item-detail__confirm">
            <table class="confirm-table">
                <tr class="price-confirm">
                    <th>商品代金</th>
                    <td>¥{{ $item->item_price }}</td>
                </tr>
                <tr class="payment-confirm">
                    <th>支払方法</th>
                    <td><p id="selected-method">未選択</p></td>
                </tr>
            </table>
            <form action="/" class="comfirm-button">
                <button class="purchase-button">
                    購入する
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    // 1. セレクトボックスと、表示場所の要素を取得する
    const paymentSelect = document.getElementById('payment-select');
    const displaySpan = document.getElementById('selected-method');

    // 2. セレクトボックスの中身が変わった（change）時に動く処理
    paymentSelect.addEventListener('change', function() {
        // 3. 今選ばれている値を取得
        const selectedValue = paymentSelect.value;
        
        // 4. 表示場所の文字を書き換える
        displaySpan.textContent = selectedValue;
    });
</script>
@endsection