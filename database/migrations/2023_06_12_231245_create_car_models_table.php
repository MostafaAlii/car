<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status')->default(false);
            $table->foreignId('car_make_id')->constrained('car_makes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('car_models');
    }
};
