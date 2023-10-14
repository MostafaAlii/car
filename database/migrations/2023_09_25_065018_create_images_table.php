<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->enum('type', ['personal','car', 'captain', 'client']);
            $table->enum('photo_type', [
                'personal_avatar',
                'id_photo_front',
                'id_photo_back',
                'criminal_record',
                'captain_license_front',
                'captain_license_back',
                'car_license_front',
                'car_license_back',
                'car_front',
                'car_back',
                'car_right',
                'car_left',
                'car_inside',
            ]);
            $table->enum('photo_status', ['accept', 'rejected', 'not_active'])->default('not_active');
            $table->string('reject_reson')->nullable();
            $table->morphs('imageable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
