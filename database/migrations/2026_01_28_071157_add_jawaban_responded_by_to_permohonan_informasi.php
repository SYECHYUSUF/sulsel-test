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
            $table->text('jawaban')->nullable()->after('alasan');
            $table->string('responded_by')->nullable()->after('jawaban');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_permohonan_informasi', function (Blueprint $table) {
            $table->dropColumn(['jawaban', 'responded_by']);
        });
    }
};
