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
        Schema::create('tbl_permohonan_disposisi', function (Blueprint $table) {
            $table->id('id_disposisi');
            $table->integer('id_permohonan');
            $table->string('id_skpd');
            $table->text('catatan_disposisi')->nullable();
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            $table->unsignedBigInteger('disposisi_by')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_permohonan')
                ->references('id_permohonan')
                ->on('tbl_permohonan_informasi')
                ->onDelete('cascade');
            
            $table->foreign('id_skpd')
                ->references('id_skpd')
                ->on('tbl_skpd')
                ->onDelete('cascade');
            
            $table->foreign('disposisi_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_permohonan_disposisi');
    }
};
