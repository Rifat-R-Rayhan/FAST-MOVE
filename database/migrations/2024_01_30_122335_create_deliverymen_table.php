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
        Schema::create('deliverymen', function (Blueprint $table) {
            $table->id();
            $table->string('deliveryman_name');
            $table->string('phone');
            $table->string('alt_phone');
            $table->string('email');
            $table->string('password');
            $table->string('full_address');
            $table->string('police_station');
            $table->string('district');
            $table->string('division');
            $table->string('nid_front');
            $table->string('nid_back');
            $table->string('profile_img');
            $table->tinyInteger('is_active')->default(1);
            $table->timestamp('change_status_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliverymen');
    }
};
