<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_image');
            $table->string('item_name');
            $table->string('brand_name')->nullable();
            $table->integer('item_price');
            $table->foreignId('seller_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('item_detail',255);
            $table->foreignId('category_id')->constrained('categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('condition_id')->constrained('conditions')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('buyer_id')->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('purchase_address')->nullable();
            $table->string('purchase_post_code',8)->nullable();
            $table->string('purchase_building')->nullable();
            $table->timestamp('purchased_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
