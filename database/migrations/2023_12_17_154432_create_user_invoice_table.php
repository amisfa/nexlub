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
            $table->id();
            $table->ulid('invoice_id');
            $table->string('plisio_id');
            $table->unsignedBigInteger('user_id');
            $table->string('invoice_url');
            $table->string('invoice_token');
            $table->string('price_amount');
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('failed_at')->nullable();
            $table->dateTime('dropped_at')->nullable();
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
