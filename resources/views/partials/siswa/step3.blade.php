<div x-show="step === 3" class="space-y-8 animate-fade-in">
    <div>
        <h3 class="text-lg font-bold text-neutral-900 border-b border-neutral-100 pb-3 mb-6 flex items-center gap-2">
            <span class="w-1.5 h-6 bg-primary-500 rounded-full"></span>
            Data Sekolah Asal
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Sekolah --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Nama Sekolah Asal</label>
                <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $siswa->sekolahAsal->nama_sekolah ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 disabled:bg-neutral-100 disabled:text-neutral-500 disabled:cursor-not-allowed"
                       placeholder="Contoh: SD Negeri 1 Jakarta" required {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- Tahun Lulus --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Tahun Lulus</label>
                <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus', $siswa->sekolahAsal->tahun_lulus ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 disabled:bg-neutral-100 disabled:text-neutral-500 disabled:cursor-not-allowed"
                       placeholder="Contoh: 2024" min="2000" max="{{ date('Y') }}" required {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- Alamat Sekolah --}}
            <div class="md:col-span-2">
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Alamat Lengkap Sekolah Asal</label>
                <textarea name="alamat_sekolah" rows="3"
                          class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 disabled:bg-neutral-100 disabled:text-neutral-500 disabled:cursor-not-allowed resize-none"
                          placeholder="Masukkan alamat lengkap sekolah asal Anda (Jalan, Kota/Kabupaten)" required {{ $isLocked ? 'disabled' : '' }}>{{ old('alamat_sekolah', $siswa->sekolahAsal->alamat_sekolah ?? '') }}</textarea>
            </div>
        </div>
    </div>
</div>