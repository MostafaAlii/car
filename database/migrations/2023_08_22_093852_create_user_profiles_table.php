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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->text('address')->nullable();
            $table->text('bio')->nullable();
            $table->float('rate')->default(0.00);
            $table->tinyInteger('number_trips')->default(0);
            $table->tinyInteger('number_trips_cansel')->nullable();
            $table->foreignId('user_id')->index()->constrained()->cascadeOnDelete();
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
