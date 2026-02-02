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
        Schema::table('ikphns', function (Blueprint $table) {
            $table->string('id_skpd')->nullable()->after('jumlah_download');
            $table->enum('verify', ['n', 'y', 't'])->default('n')->after('id_skpd');
            $table->date('tgl_verify')->nullable()->after('verify');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ikphns', function (Blueprint $table) {
            $table->dropColumn(['id_skpd', 'verify', 'tgl_verify']);
        });
    }
};
