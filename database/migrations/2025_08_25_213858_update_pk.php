<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // JOB
        DB::statement('ALTER TABLE job MODIFY id_job BIGINT UNSIGNED;'); // buang auto_increment
        DB::statement('ALTER TABLE job DROP PRIMARY KEY;');              // drop PK lama
        Schema::table('job', function (Blueprint $table) {
            $table->id()->first(); // tambahkan kolom id baru sebagai PK
        });

        // PENGHASILAN
        DB::statement('ALTER TABLE penghasilan MODIFY id_penghasilan BIGINT UNSIGNED;');
        DB::statement('ALTER TABLE penghasilan DROP PRIMARY KEY;');
        Schema::table('penghasilan', function (Blueprint $table) {
            $table->id()->first();
        });

        // AGAMA
        DB::statement('ALTER TABLE agama MODIFY id_agama BIGINT UNSIGNED;');
        DB::statement('ALTER TABLE agama DROP PRIMARY KEY;');
        Schema::table('agama', function (Blueprint $table) {
            $table->id()->first();
        });

        // PENDIDIKAN
        DB::statement('ALTER TABLE pendidikan MODIFY id_pendidikan BIGINT UNSIGNED;');
        DB::statement('ALTER TABLE pendidikan DROP PRIMARY KEY;');
        Schema::table('pendidikan', function (Blueprint $table) {
            $table->id()->first();
        });
    }

    public function down(): void
    {
        // rollback → hapus id baru
        Schema::table('job', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        Schema::table('penghasilan', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        Schema::table('agama', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        Schema::table('pendidikan', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }
};
