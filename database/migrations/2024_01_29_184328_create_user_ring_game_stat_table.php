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
        Schema::create('user_ring_game_stat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_net', 18)->default(0);
            $table->unsignedBigInteger('hand_count');
            $table->unsignedBigInteger('win_count');
            $table->unsignedBigInteger('lose_count');
            $table->unsignedDecimal('total_lose_amount', 18)->default(0);
            $table->unsignedDecimal('total_win_amount', 18)->default(0);
            $table->unsignedBigInteger('folded_on_preflop_count');
            $table->unsignedBigInteger('won_without_showdown_count');
            $table->unsignedBigInteger('showdown_count');
            $table->unsignedBigInteger('folded_on_river_count');
            $table->unsignedBigInteger('folded_on_flop_count');
            $table->unsignedBigInteger('folded_on_turn_count');
            $table->unsignedDecimal('total_bad_beat_amount', 18)->default(0);
            $table->unsignedDecimal('total_jack_pot_amount', 18)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_ring_game_stat');
    }
};
