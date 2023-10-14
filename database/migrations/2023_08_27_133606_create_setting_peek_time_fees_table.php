<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('setting_peek_time_fees', function (Blueprint $table) {
            $table->id();
            $table->text('start_date')->nullable();
            $table->text('end_date')->nullable();
            $table->text('price')->nullable();
            $table->foreignId('settings_id')->constrained('settings')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down(): void {
        Schema::dropIfExists('setting_peek_time_fees');
    }
};
