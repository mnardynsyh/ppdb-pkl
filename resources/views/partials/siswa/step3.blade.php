<div x-show="step === 3" class="space-y-6 animate-fade-in">
    <h3 class="text-xl font-semibold text-gray-800 border-b pb-2">Langkah 3: Data Sekolah Asal</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Nama Sekolah Asal --}}
        <div>
            <label for="asal_sekolah" class="block mb-2 text-sm font-medium text-gray-900">Nama Sekolah Asal</label>
            <input type="text" id="asal_sekolah" name="asal_sekolah" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                   placeholder="Contoh: SMP Negeri 1 Jakarta" 
                   value="{{ old('asal_sekolah', $siswa->asal_sekolah) }}" required>
            @error('asal_sekolah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Tahun Lulus --}}
        <div>
            <label for="tahun_lulus" class="block mb-2 text-sm font-medium text-gray-900">Tahun Lulus</label>
            <input type="number" id="tahun_lulus" name="tahun_lulus" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                   placeholder="Contoh: 2024" 
                   value="{{ old('tahun_lulus', $siswa->tahun_lulus) }}" required min="2000" max="{{ date('Y') }}">
            @error('tahun_lulus') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        
        {{-- Alamat Sekolah Asal --}}
        <div class="md:col-span-2">
            <label for="alamat_sekolah_asal" class="block mb-2 text-sm font-medium text-gray-900">Alamat Lengkap Sekolah Asal</label>
            <textarea id="alamat_sekolah_asal" name="alamat_sekolah_asal" rows="4" 
                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                      placeholder="Masukkan alamat lengkap sekolah asal Anda">{{ old('alamat_sekolah_asal', $siswa->alamat_sekolah_asal) }}</textarea>
            @error('alamat_sekolah_asal') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>
</div>

