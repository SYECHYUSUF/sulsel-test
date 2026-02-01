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
        Schema::table('tbl_permohonan_informasi', function (Blueprint $table) {
            // Add new foreign key columns
            $table->unsignedBigInteger('pekerjaan_id')->nullable()->after('pekerjaan');
            $table->unsignedBigInteger('domisili_id')->nullable()->after('alamat');
            
            // Add foreign key constraints
            $table->foreign('pekerjaan_id')->references('id')->on('master_pekerjaan')->onDelete('set null');
            $table->foreign('domisili_id')->references('id')->on('master_domisili')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_permohonan_informasi', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['pekerjaan_id']);
            $table->dropForeign(['domisili_id']);
            
            // Drop columns
            $table->dropColumn(['pekerjaan_id', 'domisili_id']);
        });
    }
};
