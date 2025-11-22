<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            if (!Schema::hasColumn('siswa', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                // tambahkan index untuk performa
                $table->index('user_id');
                // tidak menambahkan foreign key langsung jika users belum ada; kita tambahkan FK di akhir (opsional)
            }
        });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            if (Schema::hasColumn('siswa', 'user_id')) {
                $table->dropIndex(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
