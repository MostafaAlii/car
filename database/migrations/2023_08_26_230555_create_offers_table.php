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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('agent_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('company_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name')->comment('اسم العرض');
            $table->string('start_data')->nullable();
            $table->string('end_data')->nullable();
            $table->boolean('status')->default(false);
            $table->text('notes')->nullable();
            $table->string('value')->nullable()->comment('قيمه العرض');
            $table->string('price_to')->nullable()->comment('سعر قبل العرض');
            $table->string('price')->nullable()->comment('سعر بعد العرض');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
