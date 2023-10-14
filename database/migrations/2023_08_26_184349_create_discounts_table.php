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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type',['fixed','cash']);
            $table->dateTime('start_data')->nullable();
            $table->dateTime('end_data')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('use_coupon')->nullable()->comment('الحدد المسموح بيه في الاستخدام');
            $table->unsignedBigInteger('used_coupon')->default(0)->comment('استخدم كام مره من الحد المسموح');
            $table->unsignedBigInteger('value')->nullable()->comment('الخصم نفسو');
            $table->unsignedBigInteger('couponsUsed')->nullable()->comment('عدد الاستخدمات كامله');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
