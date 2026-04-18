<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;

Route::middleware('auth')->group(function (){
    Route::get('/mypage',[ProfileController::class, 'index'])->name('mypage');
    Route::get('/mypage/profile',[ProfileController::class, 'edit']);
    Route::get('/mypage/profile/update',[ProfileController::class, 'update']);
    Route::patch('/mypage/profile/update',[ProfileController::class, 'update']);
    Route::get('/purchase/{item_id}',[PurchaseController::class, 'index']);
    Route::get('/purchase/address/{item_id}',[PurchaseController::class, 'show']);
    Route::get('/purchase/address/{item_id}/update',[PurchaseController::class, 'store']);
    Route::patch('/purchase/address/{item_id}/update',[PurchaseController::class, 'store']);
    Route::get('/sell',[ItemController::class, 'exhibit']);
    Route::post('/items',[ItemController::class, 'store']);
    Route::post('/item/{item_id}/comment',[ItemController::class, 'post']);
});

Route::get('/',[ItemController::class, 'index']);

Route::get('/item/{item_id}',[ItemController::class, 'show']);