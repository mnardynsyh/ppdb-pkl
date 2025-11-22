<div x-show="step === 3" class="space-y-6 animate-fade-in">
    <h3 class="text-xl font-semibold text-gray-800 border-b pb-2">
        Langkah 3: Data Sekolah Asal
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Nama Sekolah Asal --}}
        <div>
            <label for="asal_sekolah" class="form-label">Nama Sekolah Asal</label>
            <input type="text" id="asal_sekolah" name="asal_sekolah"
                   class="form-input"
                   placeholder="Contoh: SD Negeri 1 Jakarta"
                   value="{{ old('asal_sekolah', $siswa->sekolahAsal->nama_sekolah ?? '') }}"
                   required>
            @error('asal_sekolah') <p class="error">{{ $message }}</p> @enderror
        </div>

        {{-- Tahun Lulus --}}
        <div>
            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
            <input type="number" id="tahun_lulus" name="tahun_lulus"
                   class="form-input"
                   placeholder="Contoh: 2024"
                   value="{{ old('tahun_lulus', $siswa->sekolahAsal->tahun_lulus ?? '') }}"
                   required min="2000" max="{{ date('Y') }}">
            @error('tahun_lulus') <p class="error">{{ $message }}</p> @enderror
        </div>

        {{-- Alamat Sekolah --}}
        <div class="md:col-span-2">
            <label for="alamat_sekolah_asal" class="form-label">Alamat Lengkap Sekolah Asal</label>
            <textarea id="alamat_sekolah_asal" name="alamat_sekolah_asal" rows="4"
                      class="form-input"
                      placeholder="Masukkan alamat lengkap sekolah asal Anda">{{ old('alamat_sekolah_asal', $siswa->sekolahAsal->alamat_sekolah ?? '') }}</textarea>
            @error('alamat_sekolah_asal') <p class="error">{{ $message }}</p> @enderror
        </div>

    </div>
</div>
