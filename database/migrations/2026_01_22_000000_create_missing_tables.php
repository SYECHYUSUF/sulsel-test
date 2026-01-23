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
        Schema::create('coba', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('asal')->nullable();
        });

        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah')->default(0);
        });

        Schema::create('ms_waktu', function (Blueprint $table) {
            $table->id();
            $table->string('waktu')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('tbl_users', function (Blueprint $table) {
            $table->integer('id_users')->nullable(); // DDL shows no PK, but id_users usually implies one. Following DDL strictly: it's just int.
            $table->text('username')->nullable();
            $table->text('password')->nullable();
            $table->text('no_encrypt')->nullable();
            $table->text('nm_lengkap')->nullable();
            $table->text('id_skpd')->nullable();
            $table->text('level')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_users');
        Schema::dropIfExists('ms_waktu');
        Schema::dropIfExists('kunjungan');
        Schema::dropIfExists('coba');
    }
};
