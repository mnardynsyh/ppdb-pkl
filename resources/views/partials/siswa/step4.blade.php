<div x-show="step === 4" class="space-y-10 animate-fade-in">
    
    {{-- Header Section --}}
    <div>
        <h3 class="text-lg font-bold text-neutral-900 border-b border-neutral-100 pb-3 mb-2 flex items-center gap-2">
            <span class="w-1.5 h-6 bg-primary-500 rounded-full"></span> Unggah Dokumen
        </h3>
        <p class="text-neutral-500 text-sm">Pastikan dokumen terbaca dengan jelas. Format: PDF/JPG/PNG. Maksimal 2MB per file.</p>
    </div>

    @php
        $berkasTersimpan = $siswa->Lampiran->keyBy('jenis_berkas');
        
        $renderCard = function($key, $title, $subtitle, $required=true, $isLocked=false) use ($berkasTersimpan) {
            $file = $berkasTersimpan->get($key);
            $hasFile = !is_null($file);
            $bgColor = $hasFile ? 'bg-primary-50/40 border-primary-200' : 'bg-white border-neutral-200';
            $iconColor = $hasFile ? 'text-primary-600 bg-primary-100' : 'text-neutral-400 bg-neutral-100';
            
            echo '<div class="relative rounded-2xl border '.$bgColor.' p-5 shadow-sm hover:shadow-md transition-all">';
            
            // Icon Checklist
            if ($hasFile) {
                echo '<div class="absolute top-4 right-4 text-primary-600"><i class="fa-solid fa-circle-check text-xl"></i></div>';
            }

            echo '<div class="flex items-start gap-4 mb-4">';
            echo '<div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 '.$iconColor.'"><i class="fa-solid fa-file-arrow-up"></i></div>';
            echo '<div>';
            echo '<h4 class="font-bold text-neutral-900 text-sm">'.$title. ($required ? ' <span class="text-rose-500">*</span>' : '') .'</h4>';
            echo '<p class="text-xs text-neutral-500 mt-0.5">'.$subtitle.'</p>';
            echo '</div>';
            echo '</div>'; // End Header

            echo '<div>';
            if (!$isLocked) {
                 echo '<input type="file" name="berkas['.$key.']" class="block w-full text-xs text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-neutral-100 file:text-neutral-700 hover:file:bg-neutral-200 transition-all cursor-pointer">';
            } else {
                 echo '<p class="text-xs text-neutral-400 italic bg-neutral-50 p-2 rounded border border-neutral-100 text-center">Upload terkunci.</p>';
            }

            if ($hasFile) {
                echo '<div class="mt-3 flex items-center justify-between bg-white px-3 py-2 rounded-lg border border-neutral-100 shadow-sm">';
                echo '<span class="text-xs text-neutral-600 truncate max-w-[140px] flex items-center gap-2"><i class="fa-regular fa-file"></i> '.Str::limit($file->nama_file_asli, 15).'</span>';
                echo '<a href="'.asset('storage/' . $file->path_file).'" target="_blank" class="text-xs font-bold text-primary-600 hover:underline">Lihat</a>';
                echo '</div>';
            }
            echo '</div>'; // End Content
            echo '</div>'; // End Card
        };
    @endphp

    {{-- BAGIAN 1: DOKUMEN WAJIB --}}
    <div>
        <h4 class="text-sm font-bold text-neutral-500 uppercase tracking-wider mb-4 border-b border-neutral-100 pb-2">Dokumen Wajib</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @php 
                $renderCard('pas_foto', 'Pas Foto 3x4', 'Latar Merah/Biru', true, $isLocked);
                $renderCard('kartu_keluarga', 'Kartu Keluarga', 'Scan Asli/Legalisir', true, $isLocked);
                $renderCard('akta_kelahiran', 'Akta Kelahiran', 'Scan Asli', true, $isLocked);
                $renderCard('ijazah', 'Ijazah / SKL', 'Bukti Lulus', true, $isLocked);
                $renderCard('ktp_ortu', 'KTP Orang Tua', 'Ayah/Ibu', true, $isLocked);
            @endphp
        </div>
    </div>

    {{-- BAGIAN 2: DOKUMEN PENDUKUNG --}}
    <div>
        <h4 class="text-sm font-bold text-neutral-500 uppercase tracking-wider mb-4 border-b border-neutral-100 pb-2 mt-2">Dokumen Pendukung (Opsional)</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @php
                $renderCard('sertifikat_prestasi', 'Sertifikat Prestasi', 'Gabungan PDF jika > 1', false, $isLocked);
                $renderCard('afirmasi', 'Dokumen Afirmasi', 'KIP/PKH/KKS', false, $isLocked);
                $renderCard('pindah_tugas', 'SK Pindah Tugas', 'Khusus Jalur Pindah', false, $isLocked);
            @endphp
        </div>
    </div>

</div>