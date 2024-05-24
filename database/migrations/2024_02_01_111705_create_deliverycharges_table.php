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
        Schema::create('deliverycharges', function (Blueprint $table) {
            $table->id();
            $table->string('from_location');
            $table->string('destination');
            $table->string('category');
            $table->string('delivery_type');
            $table->float('cost');
            $table->float('weight')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliverycharges');
    }
};
