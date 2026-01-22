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
        Schema::create('tbl_kat_informasi', function (Blueprint $table) {
            $table->integer('id_kat_info')->autoIncrement();
            $table->string('nm_kat_info');
            $table->string('icon');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('tbl_informasi', function (Blueprint $table) {
            $table->integer('id_informasi')->autoIncrement();
            $table->integer('id_kat_info');
            $table->string('id_skpd');
            $table->text('judul');
            $table->text('file');
            $table->timestamp('tgl_upload')->useCurrent();
            $table->integer('download')->default(0);
            $table->enum('verify', ['y', 'n', 't'])->default('n');
            $table->date('tgl_verify')->nullable();
            $table->text('ket');
            $table->integer('jumlah_download')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_permohonan_informasi', function (Blueprint $table) {
            $table->integer('id_permohonan')->autoIncrement();
            $table->string('nama')->nullable();
            $table->string('nik')->nullable();
            $table->string('email')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('rincian')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('dapat_salinan')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('nmr_pengesahan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('peroleh_informasi')->nullable();
            $table->string('salinan_informasi')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('alasan')->nullable();
            $table->integer('status')->nullable();
            $table->string('id_skpd')->nullable();
            $table->string('no_pendaftaran')->nullable();
            $table->string('file')->nullable();
            $table->enum('is_cek', ['0', '1'])->default('0');
            $table->timestamps();
        });

        Schema::create('tbl_pengajuan', function (Blueprint $table) {
            $table->integer('id_pengajuan')->autoIncrement();
            $table->string('no_pendaftaran')->nullable();
            $table->text('tujuan')->nullable();
            $table->string('nama_pemohon')->nullable();
            $table->text('alamat_pemohon')->nullable();
            $table->text('address_pemohon')->nullable();
            $table->text('apt_pemohon')->nullable();
            $table->string('city_pemohon')->nullable();
            $table->string('state_pemohon')->nullable();
            $table->string('pekerjaan_pemohon')->nullable();
            $table->string('no_telp_pemohon')->nullable();
            $table->string('email_pemohon')->nullable();
            $table->string('nama_kuasa')->nullable();
            $table->text('alamat_kuasa')->nullable();
            $table->text('address_kuasa')->nullable();
            $table->text('apt_kuasa')->nullable();
            $table->string('city_kuasa')->nullable();
            $table->string('state_kuasa')->nullable();
            $table->string('no_telp_kuasa')->nullable();
            $table->text('kasus')->nullable();
            $table->enum('status', ['n', 'y', 't', 'a'])->nullable();
            $table->enum('is_cek', ['0', '1'])->default('0');
            $table->string('id_skpd')->nullable();
            $table->string('alasan')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_alasan_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pengajuan')->nullable();
            $table->string('alasan')->nullable();
            $table->timestamps();
        });

        Schema::create('ms_bentuk_informasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->timestamps();
        });

        Schema::create('ms_daftar_informasi_publik', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('slug')->nullable();
            $table->bigInteger('is_active')->default(0);
            $table->timestamps();
        });

        Schema::create('daftar_informasi_publik', function (Blueprint $table) {
            $table->id();
            $table->string('a')->default('');
            $table->string('b')->default('');
            $table->string('c')->default('');
            $table->string('d')->default('');
            $table->string('e')->default('');
            $table->string('f')->default('');
            $table->string('g')->default('');
            $table->string('h')->default('');
            $table->bigInteger('id_md_informasi_publik')->nullable();
            $table->bigInteger('is_active')->default(1);
            $table->timestamps();
        });

        // Tambahkan ini di dalam function up() file create_information_service_tables.php
        $extraTables = ['informasis', 'informasiis', 'informasiiis'];
        foreach ($extraTables as $tableName) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->string('a')->nullable();
                $table->string('b')->nullable();
                $table->string('c')->nullable();
                $table->string('d')->nullable();
                $table->string('e')->nullable();
                $table->string('f')->nullable();
                $table->string('g')->nullable();
                $table->string('h')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_informasi_publik');
        Schema::dropIfExists('ms_daftar_informasi_publik');
        Schema::dropIfExists('ms_bentuk_informasi');
        Schema::dropIfExists('tbl_alasan_pengajuan');
        Schema::dropIfExists('tbl_pengajuan');
        Schema::dropIfExists('tbl_permohonan_informasi');
        Schema::dropIfExists('tbl_informasi');
        Schema::dropIfExists('tbl_kat_informasi');
    }
};
