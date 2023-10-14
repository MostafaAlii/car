<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable()->unique();
            $table->unsignedFloat('version')->nullable();
            $table->string('api_secret_key')->nullable();
            $table->string('open_door')->nullable();
            $table->string('waiting_price')->nullable();
            $table->string('country_tax')->nullable();
            $table->string('kilo_price')->nullable();
            $table->string('ocean')->nullable();
            $table->string('company_commission')->nullable();
            $table->string('company_tax')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('settings');
    }
};
