<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tbl_profil', function (Blueprint $table) {
            $table->string('ig_gubernur')->nullable()->after('foto_wakil');
            $table->string('fb_gubernur')->nullable()->after('ig_gubernur');
            $table->string('ig_wakil')->nullable()->after('fb_gubernur');
            $table->string('fb_wakil')->nullable()->after('ig_wakil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_profil', function (Blueprint $table) {
            $table->dropColumn(['ig_gubernur', 'fb_gubernur', 'ig_wakil', 'fb_wakil']);
        });
    }
};
