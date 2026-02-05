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
        Schema::table('tbl_permohonan_informasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_bentuk_informasi')->nullable()->after('salinan_informasi');
            $table->string('contoh_informasi')->nullable()->after('id_bentuk_informasi');

            // Add foreign key constraint
            $table->foreign('id_bentuk_informasi')->references('id')->on('ms_bentuk_informasi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_permohonan_informasi', function (Blueprint $table) {
            $table->dropForeign(['id_bentuk_informasi']);
            $table->dropColumn(['id_bentuk_informasi', 'contoh_informasi']);
        });
    }
};
