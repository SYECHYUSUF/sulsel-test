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

        Schema::create('ms_daftar_informasi_publik', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('slug')->nullable();
            $table->bigInteger('is_active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_informasi_publik');
        Schema::dropIfExists('ms_daftar_informasi_publik');
    }
};
