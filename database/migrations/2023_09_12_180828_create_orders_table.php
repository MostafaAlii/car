<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('captain_id')->constrained('captains')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('trip_type_id')->constrained('trip_types')->cascadeOnDelete()->cascadeOnUpdate();
//            $table->enum('typeOrders',['one','time','travel']);
            $table->string('order_code');
            $table->string('total_price');
            $table->string('address_now');
            $table->string('address_going');
            $table->string('time_trips');
            $table->string('distance');
            $table->string('chat_id');
            $table->enum('status', ['done', 'waiting', 'pending', 'cancel', 'accepted'])->default('pending');
            $table->enum('payments', ['cash', 'masterCard', 'wallet']);
            $table->string('lat_caption');
            $table->string('long_caption');
            $table->string('lat_user');
            $table->string('long_user');
            $table->string('lat_going');
            $table->string('long_going');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
