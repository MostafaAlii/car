<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('settings_translation', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('name')->nullable();
            $table->string('author')->nullable();
            $table->text('address')->nullable();
            $table->longText('description')->nullable();
            $table->longText('road_toll')->nullable();
            $table->unique(['settings_id', 'locale']);
            $table->index(['settings_id', 'locale']);
            $table->foreignId('settings_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('settings_translations');
    }
};
