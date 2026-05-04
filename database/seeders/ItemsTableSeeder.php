<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
            'item_image' => 'items/clock.jpg',
            'item_name' => '腕時計',
            'brand_name' => 'Rolax',
            'item_price' =>15000,
            'seller_id' =>1,
            'item_detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'condition_id' =>1,
            'buyer_id' => null,
            'purchase_address' => null,
            'purchase_post_code' => null,
            'purchase_building' => null,
            'purchased_at' => null
            ],
            [
            'item_image' => 'items/hdd.jpg',
            'item_name' => 'HDD',
            'brand_name' => '西芝',
            'item_price' =>5000,
            'seller_id' =>3,
            'item_detail' => '高性能で信頼性の高いハードディスク',
            'condition_id' =>2,
            'buyer_id' => null,
            'purchase_address' => null,
            'purchase_post_code' => null,
            'purchase_building' => null,
            'purchased_at' => null
            ],
            [
            'item_image' => 'items/onions.jpg',
            'item_name' => '玉ねぎ3束',
            'brand_name' => 'なし',
            'item_price' =>300,
            'seller_id' =>2,
            'item_detail' => '新鮮な玉ねぎの3束セット',
            'condition_id' =>3,
            'buyer_id' => null,
            'purchase_address' => null,
            'purchase_post_code' => null,
            'purchase_building' => null,
            'purchased_at' => null
            ],
            [
            'item_image' => 'items/shoes.jpg',
            'item_name' => '革靴',
            'brand_name' => null,
            'item_price' =>4000,
            'seller_id' =>3,
            'item_detail' => 'クラシックなデザインの革靴',
            'condition_id' =>4,
            'buyer_id' => null,
            'purchase_address' => null,
            'purchase_post_code' => null,
            'purchase_building' => null,
            'purchased_at' => null
            ],
            [
            'item_image' => 'items/laptop.jpg',
            'item_name' => 'ノートPC',
            'brand_name' => null,
            'item_price' =>45000,
            'seller_id' =>3,
            'item_detail' => '高性能なノートパソコン',
            'condition_id' =>1,
            'buyer_id' => null,
            'purchase_address' => null,
            'purchase_post_code' => null,
            'purchase_building' => null,
            'purchased_at' => null
            ],
            [
            'item_image' => 'items/mic.jpg',
            'item_name' => 'マイク',
            'brand_name' => 'なし',
            'item_price' =>8000,
            'seller_id' =>1,
            'item_detail' => '高性能のレコーディング用マイク',
            'condition_id' =>2,
            'buyer_id' => null,
            'purchase_address' => null,
            'purchase_post_code' => null,
            'purchase_building' => null,
            'purchased_at' => null
            ],
            [
            'item_image' => 'items/bag.jpg',
            'item_name' => 'ショルダーバッグ',
            'brand_name' => null,
            'item_price' =>3500,
            'seller_id' =>2,
            'item_detail' => 'おしゃれなショルダーバッグ',
            'condition_id' =>3,
            'buyer_id' => null,
            'purchase_address' => null,
            'purchase_post_code' => null,
            'purchase_building' => null,
            'purchased_at' => null
            ],
            [
            'item_image' => 'items/tumbler.jpg',
            'item_name' => 'タンブラー',
            'brand_name' => 'なし',
            'item_price' =>500,
            'seller_id' =>3,
            'item_detail' => '使いやすいタンブラー',
            'condition_id' =>4,
            'buyer_id' => null,
            'purchase_address' => null,
            'purchase_post_code' => null,
            'purchase_building' => null,
            'purchased_at' => null
            ],
            [
            'item_image' => 'items/grinder.jpg',
            'item_name' => 'コーヒーミル',
            'brand_name' => 'Starbacks',
            'item_price' =>4000,
            'seller_id' => 3,
            'item_detail' => '手動のコーヒーミル',
            'condition_id' =>2,
            'buyer_id' => null,
            'purchase_address' => null,
            'purchase_post_code' => null,
            'purchase_building' => null,
            'purchased_at' => null
            ],
            [
            'item_image' => 'items/cosmetics.jpg',
            'item_name' => 'メイクセット',
            'brand_name' => null,
            'item_price' =>2500,
            'seller_id' =>2,
            'item_detail' => '便利なメイクアップセット',
            'condition_id' =>2,
            'buyer_id' => null,
            'purchase_address' => null,
            'purchase_post_code' => null,
            'purchase_building' => null,
            'purchased_at' => null
            ],
    ];
    
    DB::table('items')->insert($items);

    }
}
