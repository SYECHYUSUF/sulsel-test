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
        Schema::create('tbl_skpd', function (Blueprint $table) {
            $table->string('id_skpd', 10)->primary();
            $table->string('nm_skpd')->nullable();
            $table->text('visimisi')->nullable();
            $table->text('tupoksi')->nullable();
            $table->text('tujuan')->nullable();
            $table->text('renstra')->nullable();
            $table->text('renja')->nullable();
            $table->text('lakip')->nullable();
            $table->text('alamat')->nullable();
            $table->string('email', 150)->nullable();
            $table->string('situs', 100)->nullable();
            $table->string('no_tlp', 20)->nullable();
            $table->string('lat', 100)->nullable();
            $table->string('longi', 100)->nullable();
            $table->string('kadis', 200)->nullable();
            $table->string('foto_kadis', 200)->nullable();
            $table->string('sek', 200)->nullable();
            $table->string('foto_sek', 200)->nullable();
            $table->text('struktur_organisasi')->nullable();
            $table->enum('jenis', ['opd', 'kab'])->nullable();
            $table->enum('is_active', ['1', '0'])->default('1');
            $table->string('website')->nullable();
            $table->timestamps();
        });

        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->integer('count')->default(0);
            $table->timestamps();
        });

        Schema::create('log_login', function (Blueprint $table) {
            $table->id();
            $table->string('id_user')->nullable();
            $table->string('tipe')->nullable();
            $table->string('ip')->nullable();
            $table->timestamp('createdAt')->nullable();
        });

        Schema::create('ms_survey', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->integer('urutan')->nullable();
            $table->text('soal')->nullable();
            $table->enum('tipe', ['text', 'radio', 'checkbox', 'date', 'textarea'])->nullable();
            $table->timestamps();
        });

        Schema::create('ms_detail_survey', function (Blueprint $table) {
            $table->id();
            $table->string('kode_survey')->nullable();
            $table->string('value')->nullable();
            $table->string('ket')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_survey', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('lembaga')->nullable();
            $table->text('alamat')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('kode_soal')->nullable();
            $table->string('value')->nullable();
            $table->text('masukan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_survey');
        Schema::dropIfExists('ms_detail_survey');
        Schema::dropIfExists('ms_survey');
        Schema::dropIfExists('log_login');
        Schema::dropIfExists('visitors');
        Schema::dropIfExists('tbl_skpd');
    }
};
