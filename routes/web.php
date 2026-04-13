<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;

Route::get('/',[ItemController::class, 'index']);

Route::get('/item/{id}',[ItemController::class, 'show']);

Route::middleware('auth')->group(function (){
    Route::get('/',[ItemController::class, 'index']);
    });

Route::get('/mypage', function () {
    return view('mypage');
});

Route::get('/mypage/profile', function () {
    return view('mypage_profile');
});

Route::get('/purchase/item/', function () {
    return view('purchase');
});

Route::get('/purchase/address/', function () {
    return view('purchase_address');
});

Route::get('/sell', function () {
    return view('sell');
});