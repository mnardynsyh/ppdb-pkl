<div x-show="step === 4" class="space-y-8 animate-fade-in">
    <div>
        <h3 class="text-lg font-bold text-neutral-900 border-b border-neutral-100 pb-3 mb-2 flex items-center gap-2">
            <span class="w-1.5 h-6 bg-primary-500 rounded-full"></span> Unggah Dokumen
        </h3>
        <p class="text-neutral-500 text-sm">Format: PDF/JPG. Maks 2MB.</p>
    </div>

    @php
        $berkasTersimpan = $siswa->Lampiran->keyBy('jenis_berkas');
        $renderCard = function($key, $title, $subtitle, $required=true, $isLocked=false) use ($berkasTersimpan) {
            $file = $berkasTersimpan->get($key);
            $hasFile = !is_null($file);
            $bgColor = $hasFile ? 'bg-primary-50/40 border-primary-200' : 'bg-white border-neutral-200';
            $iconColor = $hasFile ? 'text-primary-600 bg-primary-100' : 'text-neutral-400 bg-neutral-100';
            
            echo '<div class="relative rounded-2xl border '.$bgColor.' p-5 shadow-sm hover:shadow-md transition-all">';
            if ($hasFile) echo '<div class="absolute top-4 right-4 text-primary-600"><i class="fa-solid fa-circle-check text-xl"></i></div>';
            echo '<div class="flex items-start gap-4 mb-4"><div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 '.$iconColor.'"><i class="fa-solid fa-file-arrow-up"></i></div>';
            echo '<div><h4 class="font-bold text-neutral-900 text-sm">'.$title. ($required ? ' <span class="text-rose-500">*</span>' : '') .'</h4><p class="text-xs text-neutral-500 mt-0.5">'.$subtitle.'</p></div></div>';
            
            if (!$isLocked) {
                 echo '<input type="file" name="berkas['.$key.']" class="block w-full text-xs text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-neutral-100 file:text-neutral-700 hover:file:bg-neutral-200 transition-all cursor-pointer">';
            } else {
                 echo '<p class="text-xs text-neutral-400 italic">Upload terkunci.</p>';
            }

            if ($hasFile) {
                echo '<div class="mt-3 flex items-center justify-between bg-white px-3 py-2 rounded-lg border border-neutral-100"><span class="text-xs text-neutral-600 truncate max-w-[150px]"><i class="fa-regular fa-file mr-1"></i> '.Str::limit($file->nama_file_asli, 15).'</span><a href="'.asset('storage/' . $file->path_file).'" target="_blank" class="text-xs font-bold text-primary-600 hover:underline">Lihat</a></div>';
            }
            echo '</div>';
        };
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @php 
            $renderCard('pas_foto', 'Pas Foto 3x4', 'Latar Merah', true, $isLocked);
            $renderCard('kartu_keluarga', 'Kartu Keluarga', 'Scan Asli', true, $isLocked);
            $renderCard('akta_kelahiran', 'Akta Kelahiran', 'Scan Asli', true, $isLocked);
            $renderCard('ijazah', 'Ijazah / SKL', 'Bukti Lulus', true, $isLocked);
            $renderCard('ktp_ortu', 'KTP Orang Tua', 'Ayah/Ibu', true, $isLocked);
            
            $renderCard('sertifikat_prestasi', 'Sertifikat Prestasi', 'Jika Ada', false, $isLocked);
            $renderCard('afirmasi', 'Dokumen Afirmasi', 'KIP/PKH', false, $isLocked);
            $renderCard('pindah_tugas', 'SK Pindah Tugas', 'Khusus Jalur Pindah', false, $isLocked);
        @endphp
    </div>
</div>