<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('package_id')->nullable()->constrained('packages')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('subscription_id')->nullable()->constrained('subscriptions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('offer_id')->nullable()->constrained('offers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('type', ['package', 'subscription', 'offer']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_subscriptions');
    }
};
