<?php

use App\Enums\WithdrawStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_withdraw', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('status')->default(WithdrawStatuses::Waiting);
            $table->unsignedBigInteger('user_id');
            $table->unsignedDecimal('amount', 18)->default(0);
            $table->string('tx_url')->nullable();
            $table->string('rejected_comment')->nullable();
            $table->string('currency')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_withdraw');
    }
};
