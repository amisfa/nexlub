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
        Schema::create('user_payment', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id');
            $table->unsignedBigInteger('user_id');
            $table->string('pay_address');
            $table->string('price_amount');
            $table->string('price_currency');
            $table->string('pay_amount');
            $table->string('pay_currency');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_payment');
    }
};
