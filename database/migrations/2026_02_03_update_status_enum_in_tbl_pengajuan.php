<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Using raw SQL because changing ENUM values can be tricky with Blueprint
        // and may require doctrine/dbal. This is more direct for MySQL.
        DB::statement("ALTER TABLE tbl_pengajuan MODIFY COLUMN status ENUM('n', 'y', 't', 'a', 'p', 'd') DEFAULT 'n'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE tbl_pengajuan MODIFY COLUMN status ENUM('n', 'y', 't', 'a') DEFAULT 'n'");
    }
};
