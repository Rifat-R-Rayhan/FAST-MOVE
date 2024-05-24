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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_category');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('full_address');
            $table->string('divisions');
            $table->string('district');
            $table->string('police_station');
            $table->string('delivery_type');
            $table->uuid('order_tracking_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->decimal('cod_amount', 10, 2);
            $table->string('invoice');
            $table->text('note')->nullable();
            $table->decimal('product_weight', 8, 2);
            $table->string('exchange_status');
            $table->decimal('delivery_charge');
            $table->string('is_active')->default(1);
            $table->unsignedBigInteger('deliveryman_id')->nullable();
            $table->unsignedBigInteger('pickupman_id')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deliveryman_id')->references('id')->on('deliverymen')->onDelete('cascade');
            $table->foreign('pickupman_id')->references('id')->on('pickupmen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
