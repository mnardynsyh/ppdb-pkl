{{-- Helper untuk setiap baris data --}}
@php
    function renderDetailRow($label, $value) {
        if (empty($value)) $value = '-';
        echo '<div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4 py-3 border-b border-gray-100 dark:border-gray-700">';
        echo '<dt class="font-medium text-gray-500 dark:text-gray-400">' . e($label) . '</dt>';
        echo '<dd class="mt-1 text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">' . e($value) . '</dd>';
        echo '</div>';
    }
@endphp

{{-- Card: Data Calon Siswa --}}
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b dark:border-gray-600 pb-3 mb-4">Data Calon Siswa</h3>
    <dl class="text-sm">
        @php renderDetailRow('Nama Lengkap', $siswa->nama_lengkap); @endphp
        @php renderDetailRow('NISN', $siswa->nisn); @endphp
        @php renderDetailRow('NIK', $siswa->nik); @endphp
        @php renderDetailRow('Jenis Kelamin', $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'); @endphp
        @php renderDetailRow('Tempat, Tgl Lahir', ($siswa->tempat_lahir && $siswa->tanggal_lahir) ? $siswa->tempat_lahir . ', ' . \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM Y') : '-'); @endphp
        @php renderDetailRow('Agama', $siswa->agama->agama ?? '-'); @endphp
        @php renderDetailRow('Anak Ke-', $siswa->anak_ke); @endphp
        @php renderDetailRow('Alamat', $siswa->alamat); @endphp
    </dl>
</div>

{{-- Card: Data Sekolah Asal --}}
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b dark:border-gray-600 pb-3 mb-4">Data Sekolah Asal</h3>
    <dl class="text-sm">
        @php renderDetailRow('Nama Sekolah', $siswa->asal_sekolah); @endphp
        @php renderDetailRow('Tahun Lulus', $siswa->tahun_lulus); @endphp
        @php renderDetailRow('Alamat Sekolah', $siswa->alamat_sekolah_asal); @endphp
    </dl>
</div>

{{-- Card: Data Orang Tua & Wali --}}
@if($siswa->orangTuaWali)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b dark:border-gray-600 pb-3 mb-4">Data Orang Tua & Wali</h3>
        <div class="space-y-6">
            {{-- Data Ayah --}}
            <div>
                <h4 class="font-semibold text-gray-600 dark:text-gray-300 mb-2">Data Ayah</h4>
                <dl class="text-sm">
                    @php renderDetailRow('Nama Lengkap', $siswa->orangTuaWali->nama_ayah); @endphp
                    @php renderDetailRow('NIK', $siswa->orangTuaWali->nik_ayah); @endphp
                    @php renderDetailRow('Pendidikan', $siswa->orangTuaWali->pendidikanAyah->pendidikan ?? '-'); @endphp
                    @php renderDetailRow('Pekerjaan', $siswa->orangTuaWali->pekerjaanAyah->pekerjaan ?? '-'); @endphp
                    @php renderDetailRow('Penghasilan', $siswa->orangTuaWali->penghasilanAyah->penghasilan ?? '-'); @endphp
                </dl>
            </div>
            {{-- Data Ibu --}}
            <div class="border-t dark:border-gray-700 pt-4">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300 mb-2">Data Ibu</h4>
                 <dl class="text-sm">
                    @php renderDetailRow('Nama Lengkap', $siswa->orangTuaWali->nama_ibu); @endphp
                    @php renderDetailRow('NIK', $siswa->orangTuaWali->nik_ibu); @endphp
                    @php renderDetailRow('Pendidikan', $siswa->orangTuaWali->pendidikanIbu->pendidikan ?? '-'); @endphp
                    @php renderDetailRow('Pekerjaan', $siswa->orangTuaWali->pekerjaanIbu->pekerjaan ?? '-'); @endphp
                    @php renderDetailRow('Penghasilan', $siswa->orangTuaWali->penghasilanIbu->penghasilan ?? '-'); @endphp
                </dl>
            </div>
            {{-- Data Wali --}}
            @if($siswa->orangTuaWali->nama_wali)
                <div class="border-t dark:border-gray-700 pt-4">
                    <h4 class="font-semibold text-gray-600 dark:text-gray-300 mb-2">Data Wali</h4>
                    <dl class="text-sm">
                        @php renderDetailRow('Nama Lengkap', $siswa->orangTuaWali->nama_wali); @endphp
                        @php renderDetailRow('NIK', $siswa->orangTuaWali->nik_wali); @endphp
                        @php renderDetailRow('Pekerjaan', $siswa->orangTuaWali->pekerjaanWali->pekerjaan ?? '-'); @endphp
                        @php renderDetailRow('Penghasilan', $siswa->orangTuaWali->penghasilanWali->penghasilan ?? '-'); @endphp
                    </dl>
                </div>
            @endif
        </div>
    </div>
@endif

{{-- Card: Berkas Terunggah --}}
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b dark:border-gray-600 pb-3 mb-4">Berkas Terunggah</h3>
    <ul class="text-sm space-y-2">
        @forelse ($siswa->lampiran as $file)
             <li class="flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-700/50 rounded-md">
                <span class="font-medium text-gray-600 dark:text-gray-300">{{ ucwords(str_replace('_', ' ', $file->jenis_berkas)) }}</span>
                <a href="{{ Storage::url($file->path_file) }}" target="_blank" class="text-blue-600 hover:underline font-semibold">Lihat Berkas &rarr;</a>
            </li>
        @empty
            <p class="text-gray-500">Belum ada berkas yang diunggah.</p>
        @endforelse
    </ul>
</div>
