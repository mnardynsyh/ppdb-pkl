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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('image_path'); // Path untuk menyimpan lokasi gambar
            $table->integer('order')->default(0); // Untuk mengurutkan tampilan slide
            $table->boolean('is_active')->default(true); // Untuk menyembunyikan/menampilkan slide
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
