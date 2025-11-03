
<div class="space-y-6" data-aos="fade-up" data-aos-delay="100">
    @php
        function renderDataRow($label, $value) {
            echo '<div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4 py-2 border-b border-gray-100 last:border-b-0">';
            echo '<dt class="font-medium text-gray-500">' . e($label) . '</dt>';
            echo '<dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">' . ($value ? e($value) : '-') . '</dd>';
            echo '</div>';
        }
    @endphp

    {{-- Card: Data Calon Siswa --}}
    <div class="bg-white p-5 rounded-lg shadow-md border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-4">Data Calon Siswa</h3>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 text-sm">
            
            @php renderDataRow('Nama Lengkap', $siswa->nama_lengkap); @endphp
            @php renderDataRow('NISN', $siswa->nisn); @endphp
            @php renderDataRow('NIK', $siswa->nik); @endphp
            @php renderDataRow('Jenis Kelamin', $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'); @endphp
            @php renderDataRow('Tempat, Tgl Lahir', $siswa->tempat_lahir . ', ' . ($siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM Y') : '-')); @endphp
            
            @php renderDataRow('Agama', $siswa->agama); @endphp
            @php renderDataRow('Anak Ke-', $siswa->anak_ke); @endphp
            
            @php renderDataRow('Provinsi', $siswa->provinsi->nama ?? null); @endphp
            @php renderDataRow('Kabupaten/Kota', $siswa->kabupaten->nama ?? null); @endphp
            @php renderDataRow('Kecamatan', $siswa->kecamatan->nama ?? null); @endphp
            @php renderDataRow('Desa/Kelurahan', $siswa->desa->nama ?? null); @endphp
            @php renderDataRow('Detail Alamat', $siswa->alamat); @endphp
        </dl>
    </div>

    {{-- Card: Data Sekolah Asal --}}
    <div class="bg-white p-5 rounded-lg shadow-md border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-4">Data Sekolah Asal</h3>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 text-sm">
            @php renderDataRow('Nama Sekolah', $siswa->asal_sekolah); @endphp
            @php renderDataRow('Tahun Lulus', $siswa->tahun_lulus); @endphp
            @php renderDataRow('Alamat Sekolah', $siswa->alamat_sekolah_asal); @endphp
        </dl>
    </div>
    
    @if($siswa->orangTuaWali)
        <div class="bg-white p-5 rounded-lg shadow-md border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-4">Data Orang Tua & Wali</h3>
            <div class="space-y-6">
                {{-- Data Ayah --}}
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2">Data Ayah</h4>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 text-sm">
                        @php renderDataRow('Nama Lengkap', $siswa->orangTuaWali->nama_ayah); @endphp
                        @php renderDataRow('NIK', $siswa->orangTuaWali->nik_ayah); @endphp
                        @php renderDataRow('Pendidikan', $siswa->orangTuaWali->pendidikan_ayah); @endphp
                        @php renderDataRow('Pekerjaan', $siswa->orangTuaWali->pekerjaanAyah->pekerjaan ?? '-'); @endphp
                        @php renderDataRow('Penghasilan', $siswa->orangTuaWali->penghasilanAyah->penghasilan ?? '-'); @endphp
                        @php renderDataRow('Agama Ayah', $siswa->orangTuaWali->agama_ayah); @endphp
                    </dl>
                </div>
                {{-- Data Ibu --}}
                <div class="border-t pt-4">
                    <h4 class="font-semibold text-gray-700 mb-2">Data Ibu</h4>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 text-sm">
                        @php renderDataRow('Nama Lengkap', $siswa->orangTuaWali->nama_ibu); @endphp
                        @php renderDataRow('NIK', $siswa->orangTuaWali->nik_ibu); @endphp
                        @php renderDataRow('Pendidikan', $siswa->orangTuaWali->pendidikan_ibu); @endphp
                        @php renderDataRow('Pekerjaan', $siswa->orangTuaWali->pekerjaanIbu->pekerjaan ?? '-'); @endphp
                        @php renderDataRow('Penghasilan', $siswa->orangTuaWali->penghasilanIbu->penghasilan ?? '-'); @endphp
                        @php renderDataRow('Agama Ibu', $siswa->orangTuaWali->agama_ibu); @endphp
                    </dl>
                </div>
                {{-- Data Wali --}}
                @if($siswa->orangTuaWali->nama_wali)
                    <div class="border-t pt-4">
                        <h4 class="font-semibold text-gray-700 mb-2">Data Wali</h4>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 text-sm">
                            @php renderDataRow('Nama Lengkap', $siswa->orangTuaWali->nama_wali); @endphp
                            @php renderDataRow('NIK', $siswa->orangTuaWali->nik_wali); @endphp
                            @php renderDataRow('Pendidikan', $siswa->orangTuaWali->pendidikan_wali); @endphp
                            @php renderDataRow('Pekerjaan', $siswa->orangTuaWali->pekerjaanWali->pekerjaan ?? '-'); @endphp
                            @php renderDataRow('Penghasilan', $siswa->orangTuaWali->penghasilanWali->penghasilan ?? '-'); @endphp
                            @php renderDataRow('Agama Wali', $siswa->orangTuaWali->agama_wali); @endphp
                        </dl>
                    </div>
                @endif
            </div>
        </div>
    @endif
    
    {{-- Card: Berkas Terunggah --}}
    <div class="bg-white p-5 rounded-lg shadow-md border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-4">Berkas Terunggah</h3>
        <ul class="text-sm space-y-2">
            @forelse ($siswa->lampiran as $file)
                 <li class="flex items-center justify-between p-2 bg-gray-50 rounded-md">
                    <span class="font-medium text-gray-600">{{ ucwords(str_replace('_', ' ', $file->jenis_berkas)) }}</span>
                    <a href="{{ Storage::url($file->path_file) }}" target="_blank" class="text-blue-600 hover:underline font-semibold">Lihat Berkas</a>
                </li>
            @empty
                <p class="text-gray-500">Belum ada berkas yang diunggah.</p>
            @endforelse
        </ul>
    </div>
</div>

