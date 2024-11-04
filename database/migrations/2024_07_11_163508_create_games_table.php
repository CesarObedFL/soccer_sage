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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('match_id');
            $table->foreignId('league_id')->constrained();
            $table->dateTime('date');
            $table->enum('status', ['not_started', 'first_half', 'finished']);
            $table->string('home_team', length: 50);
            $table->string('away_team', length: 50);
            $table->string('score', length: 6);                             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
