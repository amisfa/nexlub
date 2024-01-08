<?php

use App\Enums\CashOutStatuses;
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
            $table->unsignedTinyInteger('status')->default(CashOutStatuses::Waiting);
            $table->unsignedBigInteger('user_id');
            $table->unsignedDecimal('amount', 18, 2)->default(0);

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
