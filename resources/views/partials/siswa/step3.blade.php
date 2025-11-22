<div x-show="step === 3" class="space-y-8 animate-fade-in">
    
    <div>
        <h3 class="text-xl font-semibold text-slate-800 border-b pb-3 mb-6">
            Langkah 3: Data Sekolah Asal
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Nama Sekolah Asal --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Nama Sekolah Asal</label>
                <input type="text" name="nama_sekolah"
                       value="{{ old('nama_sekolah', $siswa->sekolahAsal->nama_sekolah ?? '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Contoh: SMP Negeri 1 Jakarta" required>
                @error('nama_sekolah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Tahun Lulus --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Tahun Lulus</label>
                <input type="number" name="tahun_lulus"
                       value="{{ old('tahun_lulus', $siswa->sekolahAsal->tahun_lulus ?? '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Contoh: {{ date('Y') }}"
                       min="2000" max="{{ date('Y') }}" required>
                @error('tahun_lulus') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Alamat Sekolah --}}
            <div class="md:col-span-2">
                <label class="block mb-2 text-sm font-medium text-slate-900">Alamat Lengkap Sekolah Asal</label>
                <textarea name="alamat_sekolah" rows="4"
                          class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Masukkan alamat lengkap sekolah asal Anda (Jalan, Kota/Kabupaten)" required>{{ old('alamat_sekolah', $siswa->sekolahAsal->alamat_sekolah ?? '') }}</textarea>
                @error('alamat_sekolah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

        </div>
    </div>

</div>