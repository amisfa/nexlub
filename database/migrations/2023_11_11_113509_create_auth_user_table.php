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
        Schema::create('auth_user', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->unsignedInteger('affiliate_rake_percentage')->default(20);
            $table->unsignedInteger('rake_back_percentage')->default(5);
            $table->string('password');
            $table->string('wallet_no')->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('referrer_id')->nullable();
            $table->unsignedTinyInteger('avatar');
            $table->foreign('referrer_id')->references('id')->on('auth_user');
            $table->string('referral_token')->unique();
            $table->unsignedDecimal('balance', 18)->default(0);

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auth_user');
    }
};
