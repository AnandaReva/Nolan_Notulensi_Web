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
        Schema::create('revision_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('meeting_id');
            $table->longText('content_before')->nullable();
            $table->longText('content_after')->nullable();
            $table->longText('action_before')->nullable();
            $table->longText('action_after')->nullable();
            $table->timestamp('created_at');
            
            $table->foreign('meeting_id')->references('id')->on('meeting');
        });
    }

    public function down()
    {
        Schema::dropIfExists('revision_history');
    }
};


