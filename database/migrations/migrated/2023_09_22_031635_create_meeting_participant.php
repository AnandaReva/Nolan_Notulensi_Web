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
        Schema::create('meeting_participant', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('meeting_id');
            $table->unsignedBigInteger('participant_id');
            $table->boolean('attendance_status'); 
            $table->string('signature', 225);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_participant');
    }
};
