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
        Schema::create('tbl_pengajuan_respon', function (Blueprint $table) {
            $table->id('id_respon');
            $table->unsignedBigInteger('id_disposisi');
            $table->text('isi_respon');
            $table->unsignedBigInteger('respon_by');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_disposisi')
                ->references('id_disposisi')
                ->on('tbl_pengajuan_disposisi')
                ->onDelete('cascade');
            
            $table->foreign('respon_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pengajuan_respon');
    }
};
