<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            if (Schema::hasColumn('siswa', 'email')) {
                $table->dropUnique('siswa_email_unique'); // nama index dari dump
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('siswa', 'password')) {
                $table->dropColumn('password');
            }
            if (Schema::hasColumn('siswa', 'role_id')) {
                // jika ingin menyimpan role di siswa, jangan drop. Jika ingin hapus:
                $table->dropForeign(['role_id']);
                $table->dropColumn('role_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            if (!Schema::hasColumn('siswa', 'role_id')) {
                $table->unsignedBigInteger('role_id')->default(2);
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            }
            if (!Schema::hasColumn('siswa', 'email')) {
                $table->string('email')->unique();
            }
            if (!Schema::hasColumn('siswa', 'password')) {
                $table->string('password');
            }
        });
    }
};
