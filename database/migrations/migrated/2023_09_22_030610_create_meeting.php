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
        Schema::create('meeting', function (Blueprint $table) {
            $table->id();

         

            $table->string('title', 225);
            $table->timestamps();
            $table->string('location', 225);
            $table->string('inisiator', 255);
            $table->string('note_taker', 225);
            $table->enum('meeting_status', ['Approved', 'Distributed']);

            $table->unsignedBigInteger('former_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting');
    }
};
