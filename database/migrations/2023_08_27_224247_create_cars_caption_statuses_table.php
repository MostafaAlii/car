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
        Schema::create('cars_caption_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cars_caption_id')->nullable()->constrained('cars_captions')->cascadeOnDelete();
            $table->foreignId('captain_profile_id')->nullable()->constrained('captain_profiles')->cascadeOnDelete();
            $table->enum('status', ['accept', 'reject', 'not_active'])->default('not_active');
            $table->enum('type_photo',['personal','car']);
            $table->string('name_photo');
            $table->text('reject_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars_caption_statuses');
    }
};
