<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('agent_profiles', function (Blueprint $table) {
            $table->id();
            $table->text('bio')->nullable();
            $table->foreignId('agent_id')->constrained()->cascadeOnDelete();
            $table->string('uuid')->unique();
            $table->string('avatar')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('agent_profiles');
    }
};
