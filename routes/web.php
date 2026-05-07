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
    
    Route::post('/purchase/{item_id}/checkout', [PurchaseController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success/{item_id}', [PurchaseController::class, 'success'])->name('checkout-success');
    Route::get('/checkout/cancel/{item_id}', [PurchaseController::class, 'cancel'])->name('checkout-cancel');
    Route::get('/sell',[ItemController::class, 'exhibit']);
    Route::post('/items',[ItemController::class, 'store']);
    Route::post('/item/{item_id}/comment',[ItemController::class, 'post']);
    Route::post('/items/{item_id}/like', [LikeController::class, 'toggleLike']);
});

Route::get('/',[ItemController::class, 'index'])->name('items');

Route::get('/item/{item_id}',[ItemController::class, 'show'])->name('item.detail');


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/mypage/profile');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return redirect()->route('verification.notice')->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');