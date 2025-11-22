<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    public function up(): void
    {
        // Jika tabel siswa tidak punya kolom email -> tidak ada yang dipindah, keluar aman
        if (! Schema::hasColumn('siswa', 'email')) {
            // Log supaya mudah dilacak
            Log::info('move_siswa_accounts_to_users: table siswa has no email column — skipping migration.');
            return;
        }

        // Ambil semua siswa (ambil semua kolom supaya fleksibel)
        $siswaList = DB::table('siswa')->select('*')->get();

        foreach ($siswaList as $siswa) {

            // akses email secara aman (hindari Undefined property)
            $siswaArr = (array) $siswa;
            $email = $siswaArr['email'] ?? null;

            // Lewati jika email kosong / null
            if (empty($email)) {
                continue;
            }

            // Cek apakah user dengan email ini sudah ada
            $existingUser = DB::table('users')->where('email', $email)->first();

            if ($existingUser) {
                // Jika role sudah siswa (2), sambungkan saja
                if ((int) ($existingUser->role_id ?? 0) === 2) {
                    DB::table('siswa')->where('id', $siswa->id)->update([
                        'user_id' => $existingUser->id
                    ]);
                    continue;
                }

                // Jika bentrok (admin/operator), buat email alternatif non-conflict
                $base = preg_replace('/@.+$/', '', $email);
                $domain = 'dup.local'; // domain alternatif (non-routable)
                $newEmail = $base . '+siswa' . $siswa->id . '@' . $domain;

                // pastikan tidak ada yang pakai
                while (DB::table('users')->where('email', $newEmail)->exists()) {
                    $newEmail = $base . '+siswa' . $siswa->id . rand(1,9999) . '@' . $domain;
                }

                $userId = DB::table('users')->insertGetId([
                    'name'       => $siswaArr['nama_lengkap'] ?? ('Siswa ' . $siswa->id),
                    'email'      => $newEmail,
                    'password'   => $siswaArr['password'] ?? bcrypt(str()->random(12)),
                    'role_id'    => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('siswa')->where('id', $siswa->id)->update([
                    'user_id' => $userId
                ]);

                Log::info("move_siswa_accounts_to_users: conflict email {$email} -> created {$newEmail} for siswa_id {$siswa->id}");

                continue;
            }

            // Normal flow: buat user baru dengan email asli
            $userId = DB::table('users')->insertGetId([
                'name'       => $siswaArr['nama_lengkap'] ?? ('Siswa ' . $siswa->id),
                'email'      => $email,
                'password'   => $siswaArr['password'] ?? bcrypt(str()->random(12)),
                'role_id'    => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Update siswa.user_id
            DB::table('siswa')->where('id', $siswa->id)->update(['user_id' => $userId]);
        }
    }

    public function down(): void
    {
        // Tidak melakukan rollback otomatis (beresiko)
        Log::info('move_siswa_accounts_to_users: down() called — no automatic rollback implemented.');
    }
};
