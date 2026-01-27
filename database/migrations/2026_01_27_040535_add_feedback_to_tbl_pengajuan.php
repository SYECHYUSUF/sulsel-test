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
        Schema::table('tbl_pengajuan', function (Blueprint $table) {
            $table->text('feedback')->nullable()->after('status');
            $table->timestamp('tgl_feedback')->nullable()->after('feedback');
            $table->unsignedBigInteger('feedback_by')->nullable()->after('tgl_feedback');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_pengajuan', function (Blueprint $table) {
            $table->dropColumn(['feedback', 'tgl_feedback', 'feedback_by']);
        });
    }
};
