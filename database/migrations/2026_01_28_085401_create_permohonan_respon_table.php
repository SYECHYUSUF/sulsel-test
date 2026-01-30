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
        Schema::create('tbl_permohonan_respon', function (Blueprint $table) {
            $table->id('id_respon');
            $table->unsignedBigInteger('id_disposisi');
            $table->text('respon');
            $table->string('file')->nullable();
            $table->unsignedBigInteger('responded_by')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_disposisi')
                ->references('id_disposisi')
                ->on('tbl_permohonan_disposisi')
                ->onDelete('cascade');
            
            $table->foreign('responded_by')
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
        Schema::dropIfExists('tbl_permohonan_respon');
    }
};
