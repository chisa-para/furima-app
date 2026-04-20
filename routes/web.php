<?php

use Illuminate\Support\Facades\Route;
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
    Route::post('/purchase/{item_id}/buy',[PurchaseController::class, 'store']);
    Route::get('/sell',[ItemController::class, 'exhibit']);
    Route::post('/items',[ItemController::class, 'store']);
    Route::post('/item/{item_id}/comment',[ItemController::class, 'post']);
    Route::post('/items/{item_id}/like', [LikeController::class, 'toggleLike']);
});

Route::get('/',[ItemController::class, 'index']);

Route::get('/item/search',[ItemController::class, 'search']);

Route::get('/item/{item_id}',[ItemController::class, 'show']);