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
        Schema::create('caption_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('captain_id')->constrained('captains')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('longitude');
            $table->string('latitude');
            $table->enum('type_captain',['active','inorder']);
            $table->enum('status_captain',['active','inactive']);
            $table->enum('status_captain_work',['active','block','waiting'])->default('waiting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caption_activities');
    }
};
