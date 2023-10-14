<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cars_captions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('captain_id')->constrained('captains')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('car_make_id')->nullable()->constrained('car_makes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('car_model_id')->nullable()->constrained('car_models')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('car_type_id')->nullable()->constrained('car_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_car_id')->nullable()->constrained('category_cars')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('number_car')->nullable();
            $table->string('color_car')->nullable();
            $table->year('year_car')->nullable();
            $table->string('car_photo_before')->nullable()->comment('صوره السياره امام');
            $table->string('car_photo_behind')->nullable()->comment('صوره السياره خلف');
            $table->string('car_photo_right')->nullable()->comment('صوره السياره يمين');
            $table->string('car_photo_north')->nullable()->comment('صوره السياره شمال');
            $table->string('car_photo_inside')->nullable()->comment('صوره السياره بالداخل');
            $table->string('car_license_before')->nullable()->comment('صوره الرخصه امام');
            $table->string('car_license_behind')->nullable()->comment('صوره الرخصه خلف');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('cars_captions');
    }
};