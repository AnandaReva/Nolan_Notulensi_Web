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
        Schema::create('action', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_id');


            $table->text('item');

            $table->date('due');
            $table->unsignedBigInteger('pic');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action');
    }
};
