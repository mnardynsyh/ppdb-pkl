<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengaturan', function (Blueprint $table) {
            $table->text('alamat_sekolah')->nullable()->after('tanggal_tutup');
            $table->string('telepon')->nullable()->after('alamat_sekolah');
            $table->string('email_kontak')->nullable()->after('telepon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengaturan', function (Blueprint $table) {
            $table->dropColumn(['alamat_sekolah', 'telepon', 'email_kontak']);
        });
    }
};
