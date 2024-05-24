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
        Schema::create('frauds', function (Blueprint $table) {
            // $table->id();
            // $table->string('phone_number');
            // $table->string('disputant_name');
            // $table->text('details');
            // $table->string('steadfast_parcel_id')->nullable();
            // $table->unsignedBigInteger('user_id')->nullable();
            // $table->timestamps();
            $table->id();
            $table->string('phone_number');
            $table->string('disputant_name');
            $table->text('details');
            $table->string('fast_move_parcel_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('deliveryman_id')->nullable();
            $table->unsignedBigInteger('pickupman_id')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deliveryman_id')->references('id')->on('deliverymen')->onDelete('set null');
            $table->foreign('pickupman_id')->references('id')->on('pickupmen')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frauds');
    }
};
