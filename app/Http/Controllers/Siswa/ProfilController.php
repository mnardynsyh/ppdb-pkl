<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;

class ProfilController extends Controller
{
    /**
     * Memperbarui data profil siswa.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = $request->user();

        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('siswa')->ignore($siswa->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'pas_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // max 2MB
        ]);

        $updateData = [
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'email' => $validatedData['email'],
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        if ($request->hasFile('pas_foto')) {
            if ($siswa->pas_foto && Storage::disk('public')->exists($siswa->pas_foto)) {
                Storage::disk('public')->delete($siswa->pas_foto);
            }
            $updateData['pas_foto'] = $request->file('pas_foto')->store('pas_foto', 'public');
        }

        $siswa->update($updateData);

        // [DIPERBARUI] Mengembalikan ke halaman sebelumnya dengan pesan sukses.
        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}

