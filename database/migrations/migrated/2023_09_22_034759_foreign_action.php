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
        Schema::table('action', function (Blueprint $table) {
            // Tambahkan kolom foreign key ke 'nip' di tabel 'dosen'
           // $table->unsignedBigInteger('meeting_id');
            $table->foreign('content_id')->references('id')->on('content');

           // $table->unsignedBigInteger('participant_id');
         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('action', function (Blueprint $table) {
            // Hapus foreign key 'nip' di tabel 'dosen'
            $table->dropForeign(['content_id']);
         
        });
    }
};
