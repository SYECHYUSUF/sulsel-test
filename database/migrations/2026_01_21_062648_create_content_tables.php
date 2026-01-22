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
        Schema::create('tbl_berita', function (Blueprint $table) {
            $table->integer('id_berita')->autoIncrement();
            $table->text('judul');
            $table->text('deskripsi');
            $table->string('img_berita');
            $table->timestamp('tgl_upload')->useCurrent();
            $table->string('id_skpd');
            $table->integer('viewers')->default(0);
            $table->enum('verify', ['n', 'y', 't'])->default('n');
            $table->date('tgl_verify')->nullable();
            $table->string('slug')->nullable();
            $table->text('ket')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_profil', function (Blueprint $table) {
            $table->integer('id_profil')->autoIncrement();
            $table->string('nm_profil', 100);
            $table->text('deskripsi');
            $table->string('slug', 50);
            $table->string('tipe')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_slide', function (Blueprint $table) {
            $table->integer('id_slide')->autoIncrement();
            $table->string('nm_slide')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_sosmed', function (Blueprint $table) {
            $table->integer('id_sosmed')->primary();
            $table->string('sosmed')->nullable();
            $table->string('icon_sosmed')->nullable();
            $table->integer('urutan')->nullable();
            $table->string('judul')->nullable();
            $table->string('link_sosmed')->nullable();
            $table->timestamps();
        });

        Schema::create('sops', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('file')->nullable();
            $table->integer('jumlah_download')->nullable();
            $table->timestamps();
        });

        Schema::create('ikphns', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan')->nullable();
            $table->string('file')->nullable();
            $table->integer('jumlah_download')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ikphns');
        Schema::dropIfExists('sops');
        Schema::dropIfExists('tbl_sosmed');
        Schema::dropIfExists('tbl_slide');
        Schema::dropIfExists('tbl_profil');
        Schema::dropIfExists('tbl_berita');
    }
};
