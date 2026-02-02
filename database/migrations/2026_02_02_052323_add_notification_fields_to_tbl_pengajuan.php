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
            $table->timestamp('notified_at')->nullable()->after('tgl_feedback');
            $table->timestamp('notification_read_at')->nullable()->after('notified_at');
            $table->enum('notification_method', ['whatsapp', 'website', 'both'])->nullable()->after('notification_read_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_pengajuan', function (Blueprint $table) {
            $table->dropColumn(['notified_at', 'notification_read_at', 'notification_method']);
        });
    }
};
