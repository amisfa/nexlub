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
        Schema::create('user_invoice', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('plisio_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('invoice_url')->nullable();
            $table->string('invoice_token')->nullable();
            $table->string('price_amount');
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('failed_at')->nullable();
            $table->dateTime('dropped_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_invoice');
    }
};
