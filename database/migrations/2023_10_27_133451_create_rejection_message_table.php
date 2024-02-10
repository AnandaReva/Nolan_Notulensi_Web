<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rejection_message', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_id');
            $table->foreign('meeting_id')->references('id')->on('meeting');
            $table->text('message');
            $table->unsignedBigInteger('writer');
            $table->foreign('writer')->references('id')->on('participant');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rejection_message');
    }
};
