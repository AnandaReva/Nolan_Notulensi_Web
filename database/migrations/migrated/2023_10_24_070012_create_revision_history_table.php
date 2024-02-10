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
            $table->id();
            $table->unsignedBigInteger('meeting_id');
            $table->longText('discussion_log')->nullable();
            $table->unsignedBigInteger('editor');
            $table->timestamp('created_at')->default(now());
            $table->timestamp('updated_at')->default(now());

            

            $table->foreign('meeting_id')->references('id')->on('meeting');

        });
    }

    public function down()
    {
        Schema::dropIfExists('revision_history');
    }
};
