<div x-show="step === 4" class="space-y-6 animate-fade-in">
    <h3 class="text-xl font-semibold text-gray-800 border-b pb-2">Langkah 4: Unggah Berkas Lampiran</h3>
    
    {{-- Kotak Informasi --}}
    <div class="p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded-md" role="alert">
        <p class="font-bold">Perhatian!</p>
        <ul class="list-disc list-inside text-sm">
            <li>Format file yang diizinkan adalah: <strong>JPG, JPEG, PNG, PDF</strong>.</li>
            <li>Ukuran file maksimal: <strong>2 MB</strong> per file.</li>
            <li>Jika Anda mengunggah file baru, file lama akan otomatis terganti.</li>
            <li>Pastikan dokumen yang diunggah dapat terbaca dengan jelas.</li>
        </ul>
    </div>

    @php
        // Helper ini digunakan untuk memudahkan pengecekan dan penampilan berkas yang sudah ada.
        // 'keyBy' akan mengubah koleksi menjadi array asosiatif dengan 'jenis_berkas' sebagai kuncinya.
        $berkasTersimpan = $siswa->Lampiran->keyBy('jenis_berkas');
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
        
        <!-- Input untuk Pas Foto -->
        <div class="border p-4 rounded-lg shadow-sm bg-gray-50">
            <label for="pas_foto" class="block mb-2 text-sm font-medium text-gray-900">Pas Foto 3x4</label>
            <input type="file" id="pas_foto" name="berkas[pas_foto]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none">
            
            @if($file = $berkasTersimpan->get('pas_foto'))
                <div class="mt-2 text-sm">
                    <p class="text-gray-600">File saat ini:
                        <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="text-blue-600 hover:underline">{{ $file->nama_file_asli }}</a>
                    </p>
                </div>
            @endif
             @error('berkas.pas_foto') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Input untuk Kartu Keluarga -->
        <div class="border p-4 rounded-lg shadow-sm bg-gray-50">
            <label for="kartu_keluarga" class="block mb-2 text-sm font-medium text-gray-900">Scan Kartu Keluarga (KK)</label>
            <input type="file" id="kartu_keluarga" name="berkas[kartu_keluarga]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none">

            @if($file = $berkasTersimpan->get('kartu_keluarga'))
                <div class="mt-2 text-sm">
                    <p class="text-gray-600">File saat ini:
                        <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="text-blue-600 hover:underline">{{ $file->nama_file_asli }}</a>
                    </p>
                </div>
            @endif
            @error('berkas.kartu_keluarga') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Input untuk Ijazah -->
        <div class="border p-4 rounded-lg shadow-sm bg-gray-50">
            <label for="ijazah" class="block mb-2 text-sm font-medium text-gray-900">Scan Ijazah SMP/Sederajat</label>
            <input type="file" id="ijazah" name="berkas[ijazah]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none">

            @if($file = $berkasTersimpan->get('ijazah'))
                <div class="mt-2 text-sm">
                    <p class="text-gray-600">File saat ini:
                        <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="text-blue-600 hover:underline">{{ $file->nama_file_asli }}</a>
                    </p>
                </div>
            @endif
            @error('berkas.ijazah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Anda bisa menambahkan input file lain di sini jika diperlukan --}}

    </div>
</div>

