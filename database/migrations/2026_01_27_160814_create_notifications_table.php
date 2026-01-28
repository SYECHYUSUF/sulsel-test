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
        Schema::create('tbl_notifications', function (Blueprint $table) {
            $table->id('id_notification');
            $table->foreignId('to_user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('to_skpd_id')->nullable(); // Changed to string to support SKPD IDs like 'SKPD007'
            $table->string('type')->default('info'); // success, info, warning, error
            $table->string('title');
            $table->text('message');
            $table->string('url')->nullable();
            $table->string('notifiable_id')->nullable(); // Changed to string for generic support
            $table->string('notifiable_type')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_notifications');
    }
};
