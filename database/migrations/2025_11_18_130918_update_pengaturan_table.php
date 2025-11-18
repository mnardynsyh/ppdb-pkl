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
        Schema::table('pengaturan', function (Blueprint $table) {
            // 1. Menambahkan field tahun_ajaran
            // nullable() ditambahkan agar tidak error jika tabel sudah ada isinya
            $table->string('tahun_ajaran', 20)->nullable()->after('id'); 
            
            // 2. Mengganti nama field email_kontak menjadi email
            $table->renameColumn('email_kontak', 'email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturan', function (Blueprint $table) {
            // Kembalikan nama field seperti semula
            $table->renameColumn('email', 'email_kontak');
            
            // Hapus field tahun_ajaran
            $table->dropColumn('tahun_ajaran');
        });
    }
};