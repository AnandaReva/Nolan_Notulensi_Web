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
        Schema::table('content', function (Blueprint $table) {
            // Tambahkan kolom foreign key ke 'nip' di tabel 'dosen'
           // $table->unsignedBigInteger('meeting_id');
            $table->foreign('meeting_id')->references('id')->on('meeting');

           // $table->unsignedBigInteger('participant_id');
         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('content', function (Blueprint $table) {
            // Hapus foreign key 'nip' di tabel 'dosen'
            $table->dropForeign(['meeting_id']);
         
        });
    }
};
