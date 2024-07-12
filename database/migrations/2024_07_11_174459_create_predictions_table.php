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
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained();
            $table->string('winner', length: 30);
            $table->string('winner_comment', length: 30)->nullable();
            $table->string('percents', length: 25);
            $table->string('advice', length: 30);
            $table->string('goals', length: 30);
            $table->string('bettingclosed_prediction', length: 100)->nullable();
            $table->string('forebet_prediction', length: 100)->nullable();  
            $table->string('vitisport_prediction', length: 100)->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
