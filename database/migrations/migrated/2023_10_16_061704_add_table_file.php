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
        Schema::create('meeting_file', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_id');
            $table->string('fileName');
            $table->string('url');
            $table->foreign('meeting_id')->references('id')->on('meeting');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meeting_file');
    }
};
