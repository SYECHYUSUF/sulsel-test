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
        Schema::table('tbl_profil', function (Blueprint $table) {
            $table->string('file_banner')->nullable()->after('deskripsi');  // Maklumat - banner/card
            $table->string('foto_gubernur')->nullable()->after('file_banner'); // Profil Pemprov
            $table->string('foto_wakil')->nullable()->after('foto_gubernur');  // Profil Pemprov
            $table->string('foto_kepala')->nullable()->after('foto_wakil');    // Sambutan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_profil', function (Blueprint $table) {
            $table->dropColumn(['file_banner', 'foto_gubernur', 'foto_wakil', 'foto_kepala']);
        });
    }
};
