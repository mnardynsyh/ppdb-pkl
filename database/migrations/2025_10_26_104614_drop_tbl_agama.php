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
        // Menghapus tabel 'agama'
        Schema::dropIfExists('agama');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Membuat kembali tabel 'agama' jika migrasi di-rollback
        // Ini adalah praktik yang baik untuk membuat migrasi yang reversible
        Schema::create('agama', function (Blueprint $table) {
            $table->id();
            $table->string('agama');
            $table->timestamps(); // Asumsi tabel ini memiliki timestamps
        });
    }
};
