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
        Schema::create('captain_profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->text('address')->nullable();
            $table->text('bio')->nullable();
            $table->float('rate')->default(0.00);
            $table->tinyInteger('number_trips')->default(0);
            $table->tinyInteger('number_trips_cansel')->nullable();
            $table->foreignId('captain_id')->index()->constrained()->cascadeOnDelete();
            $table->string('photo_id_before')->comment('صوره البطاقه امام')->nullable();
            $table->string('photo_id_behind')->comment('صوره البطاقه خلف')->nullable();
            $table->string('photo_driving_before')->comment('صوره الرخصه امام')->nullable();
            $table->string('photo_driving_behind')->comment('صوره الرخصه خلف')->nullable();
            $table->string('photo_criminal')->comment('صوره فيش جنائي')->nullable();
            $table->string('photo_personal')->comment('صوره شخصيه')->default('image.jpg');
            $table->string('number_personal')->unique()->comment('رقم البطاقه')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('captain_profiles');
    }
};
