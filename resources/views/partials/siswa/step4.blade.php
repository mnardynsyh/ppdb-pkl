<div x-show="step === 4" class="space-y-10 animate-fade-in">
    {{-- Header Halaman --}}
    <div>
        <h3 class="text-2xl font-bold text-slate-800">Langkah 4: Unggah Berkas Lampiran</h3>
        <p class="text-slate-500 mt-1">Lengkapi dokumen Anda sesuai dengan persyaratan yang berlaku.</p>
    </div>
    
    {{-- Kotak Informasi --}}
    <div class="p-4 bg-blue-50 border-l-4 border-blue-500 text-blue-800 rounded-r-lg" role="alert">
        <div class="flex">
            <div class="py-1">
                <svg class="w-6 h-6 text-blue-500 mr-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="font-bold">Perhatian!</p>
                <ul class="list-disc list-inside text-sm mt-1">
                    <li>Format file yang diizinkan: <strong>JPG, JPEG, PNG, PDF</strong>.</li>
                    <li>Ukuran file maksimal: <strong>2 MB</strong> per file.</li>
                    <li>Pastikan semua dokumen yang diunggah dapat terbaca dengan jelas.</li>
                </ul>
            </div>
        </div>
    </div>

    @php
        // Mengambil semua lampiran yang sudah ada dan mengindeksnya berdasarkan jenis berkas
        $berkasTersimpan = $siswa->Lampiran->keyBy('jenis_berkas');
    @endphp

    {{-- === Dokumen Wajib === --}}
    <div class="space-y-6">
        <h4 class="text-xl font-semibold text-slate-700 border-b border-slate-200 pb-3">Dokumen Wajib</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Kartu Unggah: Pas Foto -->
            <div class="bg-white border border-slate-200 p-5 rounded-lg shadow-sm space-y-3 transition-shadow hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <label for="pas_foto" class="font-medium text-slate-800 flex items-center">Pas Foto 3x4 <span class="ml-2 text-xs text-red-500 font-semibold bg-red-100 px-2 py-0.5 rounded-full">Wajib</span></label>
                        <p class="text-sm text-slate-500 mt-1">Foto formal dengan latar belakang merah.</p>
                    </div>
                    <div class="flex-shrink-0 w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <input type="file" id="pas_foto" name="berkas[pas_foto]" class="block w-full text-sm text-slate-600 border border-slate-300 rounded-lg cursor-pointer bg-slate-50 file:bg-slate-200 file:border-0 file:px-4 file:py-2 file:mr-4 file:font-medium file:text-slate-700 hover:file:bg-slate-300 transition-colors">
                @if($file = $berkasTersimpan->get('pas_foto'))
                    <div class="!mt-2 flex items-center text-sm text-green-600 font-medium bg-green-50 p-2 rounded-md">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>Terunggah: <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="ml-1 text-blue-600 hover:underline">{{ Str::limit($file->nama_file_asli, 25) }}</a></span>
                    </div>
                @endif
                @error('berkas.pas_foto') <p class="!mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Kartu Unggah: Kartu Keluarga -->
            <div class="bg-white border border-slate-200 p-5 rounded-lg shadow-sm space-y-3 transition-shadow hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <label for="kartu_keluarga" class="font-medium text-slate-800 flex items-center">Kartu Keluarga (KK) <span class="ml-2 text-xs text-red-500 font-semibold bg-red-100 px-2 py-0.5 rounded-full">Wajib</span></label>
                        <p class="text-sm text-slate-500 mt-1">Untuk verifikasi data keluarga.</p>
                    </div>
                    <div class="flex-shrink-0 w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.282-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm-1-4a1 1 0 11-2 0 1 1 0 012 0zM4 20h2.5a1.5 1.5 0 001.5-1.5v-2.5a1.5 1.5 0 00-1.5-1.5H4a1 1 0 00-1 1v4a1 1 0 001 1z"></path></svg>
                    </div>
                </div>
                <input type="file" id="kartu_keluarga" name="berkas[kartu_keluarga]" class="block w-full text-sm text-slate-600 border border-slate-300 rounded-lg cursor-pointer bg-slate-50 file:bg-slate-200 file:border-0 file:px-4 file:py-2 file:mr-4 file:font-medium file:text-slate-700 hover:file:bg-slate-300 transition-colors">
                @if($file = $berkasTersimpan->get('kartu_keluarga'))
                    <div class="!mt-2 flex items-center text-sm text-green-600 font-medium bg-green-50 p-2 rounded-md">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>Terunggah: <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="ml-1 text-blue-600 hover:underline">{{ Str::limit($file->nama_file_asli, 25) }}</a></span>
                    </div>
                @endif
                @error('berkas.kartu_keluarga') <p class="!mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Kartu Unggah: Ijazah / SKL -->
            <div class="bg-white border border-slate-200 p-5 rounded-lg shadow-sm space-y-3 transition-shadow hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <label for="ijazah" class="font-medium text-slate-800 flex items-center">Ijazah / SKL <span class="ml-2 text-xs text-red-500 font-semibold bg-red-100 px-2 py-0.5 rounded-full">Wajib</span></label>
                        <p class="text-sm text-slate-500 mt-1">Bukti kelulusan dari sekolah sebelumnya.</p>
                    </div>
                    <div class="flex-shrink-0 w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </div>
                <input type="file" id="ijazah" name="berkas[ijazah]" class="block w-full text-sm text-slate-600 border border-slate-300 rounded-lg cursor-pointer bg-slate-50 file:bg-slate-200 file:border-0 file:px-4 file:py-2 file:mr-4 file:font-medium file:text-slate-700 hover:file:bg-slate-300 transition-colors">
                @if($file = $berkasTersimpan->get('ijazah'))
                    <div class="!mt-2 flex items-center text-sm text-green-600 font-medium bg-green-50 p-2 rounded-md">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>Terunggah: <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="ml-1 text-blue-600 hover:underline">{{ Str::limit($file->nama_file_asli, 25) }}</a></span>
                    </div>
                @endif
                @error('berkas.ijazah') <p class="!mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Kartu Unggah: Akta Kelahiran -->
            <div class="bg-white border border-slate-200 p-5 rounded-lg shadow-sm space-y-3 transition-shadow hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <label for="akta_kelahiran" class="font-medium text-slate-800 flex items-center">Akta Kelahiran <span class="ml-2 text-xs text-red-500 font-semibold bg-red-100 px-2 py-0.5 rounded-full">Wajib</span></label>
                        <p class="text-sm text-slate-500 mt-1">Untuk verifikasi usia calon siswa.</p>
                    </div>
                    <div class="flex-shrink-0 w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                </div>
                <input type="file" id="akta_kelahiran" name="berkas[akta_kelahiran]" class="block w-full text-sm text-slate-600 border border-slate-300 rounded-lg cursor-pointer bg-slate-50 file:bg-slate-200 file:border-0 file:px-4 file:py-2 file:mr-4 file:font-medium file:text-slate-700 hover:file:bg-slate-300 transition-colors">
                @if($file = $berkasTersimpan->get('akta_kelahiran'))
                    <div class="!mt-2 flex items-center text-sm text-green-600 font-medium bg-green-50 p-2 rounded-md">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>Terunggah: <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="ml-1 text-blue-600 hover:underline">{{ Str::limit($file->nama_file_asli, 25) }}</a></span>
                    </div>
                @endif
                @error('berkas.akta_kelahiran') <p class="!mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Kartu Unggah: KTP Orang Tua/Wali -->
            <div class="bg-white border border-slate-200 p-5 rounded-lg shadow-sm space-y-3 transition-shadow hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <label for="ktp_ortu" class="font-medium text-slate-800 flex items-center">KTP Orang Tua/Wali <span class="ml-2 text-xs text-red-500 font-semibold bg-red-100 px-2 py-0.5 rounded-full">Wajib</span></label>
                        <p class="text-sm text-slate-500 mt-1">Untuk validasi data orang tua.</p>
                    </div>
                    <div class="flex-shrink-0 w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                    </div>
                </div>
                <input type="file" id="ktp_ortu" name="berkas[ktp_ortu]" class="block w-full text-sm text-slate-600 border border-slate-300 rounded-lg cursor-pointer bg-slate-50 file:bg-slate-200 file:border-0 file:px-4 file:py-2 file:mr-4 file:font-medium file:text-slate-700 hover:file:bg-slate-300 transition-colors">
                @if($file = $berkasTersimpan->get('ktp_ortu'))
                    <div class="!mt-2 flex items-center text-sm text-green-600 font-medium bg-green-50 p-2 rounded-md">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>Terunggah: <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="ml-1 text-blue-600 hover:underline">{{ Str::limit($file->nama_file_asli, 25) }}</a></span>
                    </div>
                @endif
                @error('berkas.ktp_ortu') <p class="!mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

        </div>
    </div>

    {{-- === Dokumen Pendukung === --}}
    <div class="space-y-6">
        <h4 class="text-xl font-semibold text-slate-700 border-b border-slate-200 pb-3">Dokumen Pendukung (Opsional)</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Kartu Unggah: Jalur Afirmasi -->
            <div class="bg-white border-2 border-dashed border-slate-300 p-5 rounded-lg space-y-3">
                <div class="flex items-start justify-between">
                    <div>
                        <label for="afirmasi" class="font-medium text-slate-800">Dokumen Afirmasi</label>
                        <p class="text-sm text-slate-500 mt-1">Unggah salah satu: KIP/PKH/KKS/SKTM.</p>
                    </div>
                    <div class="flex-shrink-0 w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v.01M12 18v-2m0-4H9m3 0h3m-3 0v2m0 4v.01M12 21a9 9 0 110-18 9 9 0 010 18z"></path></svg>
                    </div>
                </div>
                <input type="file" id="afirmasi" name="berkas[afirmasi]" class="block w-full text-sm text-slate-600 border border-slate-300 rounded-lg cursor-pointer bg-slate-50 file:bg-slate-200 file:border-0 file:px-4 file:py-2 file:mr-4 file:font-medium file:text-slate-700 hover:file:bg-slate-300 transition-colors">
                @if($file = $berkasTersimpan->get('afirmasi'))
                     <div class="!mt-2 flex items-center text-sm text-green-600 font-medium bg-green-50 p-2 rounded-md">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>Terunggah: <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="ml-1 text-blue-600 hover:underline">{{ Str::limit($file->nama_file_asli, 25) }}</a></span>
                    </div>
                @endif
                @error('berkas.afirmasi') <p class="!mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Kartu Unggah: Sertifikat Prestasi -->
            <div class="bg-white border-2 border-dashed border-slate-300 p-5 rounded-lg space-y-3">
                <div class="flex items-start justify-between">
                    <div>
                        <label for="sertifikat_prestasi" class="font-medium text-slate-800">Sertifikat Prestasi</label>
                        <p class="text-sm text-slate-500 mt-1">Gabungkan jadi 1 file PDF jika lebih dari satu.</p>
                    </div>
                    <div class="flex-shrink-0 w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z"></path></svg>
                    </div>
                </div>
                <input type="file" id="sertifikat_prestasi" name="berkas[sertifikat_prestasi]" class="block w-full text-sm text-slate-600 border border-slate-300 rounded-lg cursor-pointer bg-slate-50 file:bg-slate-200 file:border-0 file:px-4 file:py-2 file:mr-4 file:font-medium file:text-slate-700 hover:file:bg-slate-300 transition-colors">
                @if($file = $berkasTersimpan->get('sertifikat_prestasi'))
                     <div class="!mt-2 flex items-center text-sm text-green-600 font-medium bg-green-50 p-2 rounded-md">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>Terunggah: <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="ml-1 text-blue-600 hover:underline">{{ Str::limit($file->nama_file_asli, 25) }}</a></span>
                    </div>
                @endif
                @error('berkas.sertifikat_prestasi') <p class="!mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Kartu Unggah: Nilai Rapor -->
            <div class="bg-white border-2 border-dashed border-slate-300 p-5 rounded-lg space-y-3">
                <div class="flex items-start justify-between">
                    <div>
                        <label for="nilai_rapor" class="font-medium text-slate-800">Nilai Rapor</label>
                        <p class="text-sm text-slate-500 mt-1">Scan rapor semester 1-5 (Jalur Prestasi).</p>
                    </div>
                    <div class="flex-shrink-0 w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                </div>
                <input type="file" id="nilai_rapor" name="berkas[nilai_rapor]" class="block w-full text-sm text-slate-600 border border-slate-300 rounded-lg cursor-pointer bg-slate-50 file:bg-slate-200 file:border-0 file:px-4 file:py-2 file:mr-4 file:font-medium file:text-slate-700 hover:file:bg-slate-300 transition-colors">
                @if($file = $berkasTersimpan->get('nilai_rapor'))
                     <div class="!mt-2 flex items-center text-sm text-green-600 font-medium bg-green-50 p-2 rounded-md">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>Terunggah: <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="ml-1 text-blue-600 hover:underline">{{ Str::limit($file->nama_file_asli, 25) }}</a></span>
                    </div>
                @endif
                @error('berkas.nilai_rapor') <p class="!mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Kartu Unggah: Pindah Tugas Ortu -->
            <div class="bg-white border-2 border-dashed border-slate-300 p-5 rounded-lg space-y-3">
                <div class="flex items-start justify-between">
                    <div>
                        <label for="pindah_tugas" class="font-medium text-slate-800">SK Pindah Tugas Orang Tua</label>
                        <p class="text-sm text-slate-500 mt-1">Khusus untuk Jalur Pindah Tugas Ortu.</p>
                    </div>
                    <div class="flex-shrink-0 w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <input type="file" id="pindah_tugas" name="berkas[pindah_tugas]" class="block w-full text-sm text-slate-600 border border-slate-300 rounded-lg cursor-pointer bg-slate-50 file:bg-slate-200 file:border-0 file:px-4 file:py-2 file:mr-4 file:font-medium file:text-slate-700 hover:file:bg-slate-300 transition-colors">
                @if($file = $berkasTersimpan->get('pindah_tugas'))
                     <div class="!mt-2 flex items-center text-sm text-green-600 font-medium bg-green-50 p-2 rounded-md">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>Terunggah: <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="ml-1 text-blue-600 hover:underline">{{ Str::limit($file->nama_file_asli, 25) }}</a></span>
                    </div>
                @endif
                @error('berkas.pindah_tugas') <p class="!mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            
        </div>
    </div>
</div>
