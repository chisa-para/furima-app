<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\LikeController;

Route::middleware('auth')->group(function (){
    Route::post('/mypage/profile/update',[ProfileController::class, 'store']);
    Route::get('/mypage',[ProfileController::class, 'index'])->name('mypage');
    Route::get('/mypage/profile',[ProfileController::class, 'show']);
    Route::get('/purchase/{item_id}',[PurchaseController::class, 'index']);
    Route::get('/purchase/address/{item_id}',[PurchaseController::class, 'show']);
    Route::post('/purchase/address/{item_id}/update',[PurchaseController::class, 'confirm']);
    // 1. 決済を開始する（購入ボタンの送信先）
    Route::post('/purchase/{item_id}/checkout', [PurchaseController::class, 'checkout'])->name('checkout');

    // 2. 決済成功時の戻り先
    Route::get('/checkout/success/{item_id}', [PurchaseController::class, 'success'])->name('checkout-success');

    // 3. 決済キャンセル時の戻り先
    Route::get('/checkout/cancel/{item_id}', [PurchaseController::class, 'cancel'])->name('checkout-cancel');
    Route::get('/sell',[ItemController::class, 'exhibit']);
    Route::post('/items',[ItemController::class, 'store']);
    Route::post('/item/{item_id}/comment',[ItemController::class, 'post']);
    Route::post('/items/{item_id}/like', [LikeController::class, 'toggleLike']);
});

Route::get('/',[ItemController::class, 'index'])->name('items');

Route::get('/item/{item_id}',[ItemController::class, 'show']);

// 1. 認証メール送信後の「確認してね」画面の表示
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// 2. メール内のリンクをクリックした時の処理（検証完了）
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // これが認証完了の魔法のメソッドです
    return redirect('/mypage/profile'); // 💡 認証後に飛ばしたい場所（マイページなど）に変更してください
})->middleware(['auth', 'signed'])->name('verification.verify');

// 3. 認証メールの再送処理
Route::post('/email/verification-notification', function (Request $request) {
    
    $request->user()->sendEmailVerificationNotification();
    return redirect()->route('verification.notice')->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');