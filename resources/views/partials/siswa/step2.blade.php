@php
    // Mengambil data orang tua dari relasi
    // Menggunakan optional() agar tidak error jika relasi belum ada
    $orangTuaAyah = $siswa->orangTua->where('hubungan', 'Ayah')->first();
    $orangTuaIbu  = $siswa->orangTua->where('hubungan', 'Ibu')->first();
    $orangTuaWali = $siswa->orangTua->where('hubungan', 'Wali')->first();
@endphp

<div x-show="step === 2"
     class="space-y-8 animate-fade-in"
     x-data="{
        showWali: {{ old('tinggal_dengan_wali', $orangTuaWali ? 'true' : 'false') }},
        pekerjaanAyah: '{{ old('pekerjaan_ayah', $orangTuaAyah->pekerjaan ?? '') }}',
        pekerjaanIbu: '{{ old('pekerjaan_ibu', $orangTuaIbu->pekerjaan ?? '') }}',
        pekerjaanWali: '{{ old('pekerjaan_wali', $orangTuaWali->pekerjaan ?? '') }}',
     }">

    {{-- AYAH --}}
    <div>
        <h3 class="text-xl font-semibold text-slate-800 border-b pb-3 mb-6">
            Langkah 2: Data Orang Tua — Ayah
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Nama Ayah --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Nama Lengkap Ayah</label>
                <input type="text" name="nama_ayah"
                       value="{{ old('nama_ayah', $orangTuaAyah->nama_lengkap ?? '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm"
                       placeholder="Nama lengkap ayah" required>
                @error('nama_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- NIK Ayah --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">NIK Ayah</label>
                <input type="text" inputmode="numeric" name="nik_ayah"
                       maxlength="16"
                       value="{{ old('nik_ayah', $orangTuaAyah->nik ?? '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm"
                       placeholder="16 digit NIK ayah">
                @error('nik_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Tempat Lahir Ayah --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Tempat Lahir Ayah</label>
                <input type="text" name="tempat_lahir_ayah"
                       value="{{ old('tempat_lahir_ayah', $orangTuaAyah->tempat_lahir ?? '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm"
                       placeholder="Kota atau tempat lahir">
                @error('tempat_lahir_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Agama Ayah --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Agama Ayah</label>
                <select name="agama_ayah"
                        class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm" required>
                    <option value="">-- Pilih Agama --</option>
                    @foreach (['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu','Lainnya'] as $agama)
                        <option value="{{ $agama }}"
                            {{ old('agama_ayah', $orangTuaAyah->agama ?? '') == $agama ? 'selected' : '' }}>
                            {{ $agama }}
                        </option>
                    @endforeach
                </select>
                @error('agama_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Tanggal Lahir Ayah (PERBAIKAN DISINI) --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Tanggal Lahir Ayah</label>
                <input type="date" name="tanggal_lahir_ayah"
                       value="{{ old('tanggal_lahir_ayah', !empty($orangTuaAyah->tanggal_lahir) ? \Carbon\Carbon::parse($orangTuaAyah->tanggal_lahir)->format('Y-m-d') : '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm">
                @error('tanggal_lahir_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Pendidikan Ayah --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Pendidikan Terakhir Ayah</label>
                <select name="pendidikan_ayah" class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm" required>
                    <option value="">-- Pilih Pendidikan --</option>
                    @foreach($pendidikanOptions ?? ['SD','SMP','SMA','D3','S1','S2','S3','Tidak Sekolah'] as $opt)
                        <option value="{{ $opt }}" {{ old('pendidikan_ayah', $orangTuaAyah->pendidikan_terakhir ?? '') == $opt ? 'selected' : '' }}>
                            {{ $opt }}
                        </option>
                    @endforeach
                </select>
                @error('pendidikan_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Pekerjaan Ayah --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Pekerjaan Ayah</label>
                <select name="pekerjaan_ayah" x-model="pekerjaanAyah"
                        class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm" required>
                    <option value="">-- Pilih Pekerjaan --</option>
                    @foreach($pekerjaanOptions ?? ['PNS','TNI/Polri','Wiraswasta','Swasta','Petani','Nelayan','Buruh','Lainnya'] as $opt)
                        <option value="{{ $opt }}" {{ old('pekerjaan_ayah', $orangTuaAyah->pekerjaan ?? '') == $opt ? 'selected' : '' }}>
                            {{ $opt }}
                        </option>
                    @endforeach
                </select>
                @error('pekerjaan_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Penghasilan Ayah --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Penghasilan Ayah</label>
                <select name="penghasilan_ayah" class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm" required>
                    <option value="">-- Pilih Penghasilan --</option>
                    @foreach($penghasilanOptions ?? ['< 500.000','500.000 - 1.000.000','1.000.000 - 2.000.000','2.000.000 - 5.000.000','> 5.000.000'] as $opt)
                        <option value="{{ $opt }}" {{ old('penghasilan_ayah', $orangTuaAyah->penghasilan_bulanan ?? '') == $opt ? 'selected' : '' }}>
                            {{ $opt }}
                        </option>
                    @endforeach
                </select>
                @error('penghasilan_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- No HP Ayah --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">No HP Ayah</label>
                <input type="text" name="no_hp_ayah"
                       value="{{ old('no_hp_ayah', $orangTuaAyah->no_hp ?? '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm"
                       placeholder="0812xxxx">
                @error('no_hp_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

        </div>
    </div>

    {{-- IBU --}}
    <div>
        <h3 class="text-lg font-semibold text-slate-800 border-b pb-3 mb-6">Data Ibu</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Ibu --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Nama Lengkap Ibu</label>
                <input type="text" name="nama_ibu"
                       value="{{ old('nama_ibu', $orangTuaIbu->nama_lengkap ?? '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm" required>
                @error('nama_ibu') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- NIK Ibu --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">NIK Ibu</label>
                <input type="text" inputmode="numeric" name="nik_ibu"
                       maxlength="16"
                       value="{{ old('nik_ibu', $orangTuaIbu->nik ?? '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm"
                       placeholder="16 digit NIK ibu">
                @error('nik_ibu') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Tempat Lahir Ibu --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Tempat Lahir Ibu</label>
                <input type="text" name="tempat_lahir_ibu"
                       value="{{ old('tempat_lahir_ibu', $orangTuaIbu->tempat_lahir ?? '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm">
                @error('tempat_lahir_ibu') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Agama Ibu --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Agama Ibu</label>
                <select name="agama_ibu"
                        class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm" required>
                    <option value="">-- Pilih Agama --</option>
                    @foreach (['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu','Lainnya'] as $agama)
                        <option value="{{ $agama }}"
                            {{ old('agama_ibu', $orangTuaIbu->agama ?? '') == $agama ? 'selected' : '' }}>
                            {{ $agama }}
                        </option>
                    @endforeach
                </select>
                @error('agama_ibu') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Tanggal Lahir Ibu (PERBAIKAN DISINI) --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Tanggal Lahir Ibu</label>
                <input type="date" name="tanggal_lahir_ibu"
                       value="{{ old('tanggal_lahir_ibu', !empty($orangTuaIbu->tanggal_lahir) ? \Carbon\Carbon::parse($orangTuaIbu->tanggal_lahir)->format('Y-m-d') : '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm">
                @error('tanggal_lahir_ibu') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Pendidikan Ibu --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Pendidikan Terakhir Ibu</label>
                <select name="pendidikan_ibu" class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm" required>
                    <option value="">-- Pilih Pendidikan --</option>
                    @foreach($pendidikanOptions ?? ['SD','SMP','SMA','D3','S1','S2','S3','Tidak Sekolah'] as $opt)
                        <option value="{{ $opt }}" {{ old('pendidikan_ibu', $orangTuaIbu->pendidikan_terakhir ?? '') == $opt ? 'selected' : '' }}>
                            {{ $opt }}
                        </option>
                    @endforeach
                </select>
                @error('pendidikan_ibu') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Pekerjaan Ibu --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Pekerjaan Ibu</label>
                <select name="pekerjaan_ibu" x-model="pekerjaanIbu" class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm" required>
                    <option value="">-- Pilih Pekerjaan --</option>
                    @foreach($pekerjaanOptions ?? ['PNS','TNI/Polri','Wiraswasta','Swasta','Petani','Nelayan','Buruh','Lainnya'] as $opt)
                        <option value="{{ $opt }}" {{ old('pekerjaan_ibu', $orangTuaIbu->pekerjaan ?? '') == $opt ? 'selected' : '' }}>
                            {{ $opt }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Penghasilan Ibu --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Penghasilan Ibu</label>
                <select name="penghasilan_ibu" class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm" required>
                    <option value="">-- Pilih Penghasilan --</option>
                    @foreach($penghasilanOptions ?? ['< 500.000','500.000 - 1.000.000','1.000.000 - 2.000.000','2.000.000 - 5.000.000','> 5.000.000'] as $opt)
                        <option value="{{ $opt }}" {{ old('penghasilan_ibu', $orangTuaIbu->penghasilan_bulanan ?? '') == $opt ? 'selected' : '' }}>
                            {{ $opt }}
                        </option>
                    @endforeach
                </select>
                @error('penghasilan_ibu') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- No HP Ibu --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">No HP Ibu</label>
                <input type="text" name="no_hp_ibu"
                       value="{{ old('no_hp_ibu', $orangTuaIbu->no_hp ?? '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm"
                       placeholder="0812xxxx">
                @error('no_hp_ibu') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    {{-- WALI --}}
    <div>
        <h3 class="text-lg font-semibold text-slate-800 border-b pb-3 mb-6">Data Wali (Opsional)</h3>

        <div class="flex items-center mb-4">
            <input id="waliCheck" type="checkbox" x-model="showWali" name="tinggal_dengan_wali" value="on"
                   class="w-5 h-5 text-blue-600 border-slate-300 rounded">
            <label for="waliCheck" class="ml-3 text-sm text-slate-900">Centang bila tinggal dengan wali</label>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-show="showWali">
            {{-- Nama Wali --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Nama Wali</label>
                <input type="text" name="nama_wali"
                       value="{{ old('nama_wali', $orangTuaWali->nama_lengkap ?? '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm">
            </div>

            {{-- NIK Wali --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">NIK Wali</label>
                <input type="text" inputmode="numeric" name="nik_wali" maxlength="16"
                       value="{{ old('nik_wali', $orangTuaWali->nik ?? '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm"
                       placeholder="16 digit NIK wali">
            </div>

            {{-- Tempat Lahir Wali --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Tempat Lahir Wali</label>
                <input type="text" name="tempat_lahir_wali"
                       value="{{ old('tempat_lahir_wali', $orangTuaWali->tempat_lahir ?? '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm">
            </div>

            {{-- Tanggal Lahir Wali (PERBAIKAN DISINI) --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Tanggal Lahir Wali</label>
                <input type="date" name="tanggal_lahir_wali"
                       value="{{ old('tanggal_lahir_wali', !empty($orangTuaWali->tanggal_lahir) ? \Carbon\Carbon::parse($orangTuaWali->tanggal_lahir)->format('Y-m-d') : '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm">
            </div>

            {{-- Agama Wali --}}
            <div x-show="showWali">
                <label class="block mb-2 text-sm font-medium text-slate-900">Agama Wali</label>
                <select name="agama_wali"
                        class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm">
                    <option value="">-- Pilih Agama --</option>
                    @foreach (['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu','Lainnya'] as $agama)
                        <option value="{{ $agama }}"
                            {{ old('agama_wali', $orangTuaWali->agama ?? '') == $agama ? 'selected' : '' }}>
                            {{ $agama }}
                        </option>
                    @endforeach
                </select>
                @error('agama_wali') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Pendidikan Wali --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Pendidikan Wali</label>
                <select name="pendidikan_wali" class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm">
                    <option value="">-- Pilih Pendidikan --</option>
                    @foreach($pendidikanOptions ?? ['SD','SMP','SMA','D3','S1','S2','S3','Tidak Sekolah'] as $opt)
                        <option value="{{ $opt }}" {{ old('pendidikan_wali', $orangTuaWali->pendidikan_terakhir ?? '') == $opt ? 'selected' : '' }}>
                            {{ $opt }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Pekerjaan Wali --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Pekerjaan Wali</label>
                <select name="pekerjaan_wali" x-model="pekerjaanWali" class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm">
                    <option value="">-- Pilih Pekerjaan --</option>
                    @foreach($pekerjaanOptions ?? ['PNS','TNI/Polri','Wiraswasta','Swasta','Petani','Nelayan','Buruh','Lainnya'] as $opt)
                        <option value="{{ $opt }}" {{ old('pekerjaan_wali', $orangTuaWali->pekerjaan ?? '') == $opt ? 'selected' : '' }}>
                            {{ $opt }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Penghasilan Wali --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Penghasilan Wali</label>
                <select name="penghasilan_wali" class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm">
                    <option value="">-- Pilih Penghasilan --</option>
                    @foreach($penghasilanOptions ?? ['< 500.000','500.000 - 1.000.000','1.000.000 - 2.000.000','2.000.000 - 5.000.000','> 5.000.000'] as $opt)
                        <option value="{{ $opt }}" {{ old('penghasilan_wali', $orangTuaWali->penghasilan_bulanan ?? '') == $opt ? 'selected' : '' }}>
                            {{ $opt }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- No HP Wali --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">No HP Wali</label>
                <input type="text" name="no_hp_wali"
                       value="{{ old('no_hp_wali', $orangTuaWali->no_hp ?? '') }}"
                       class="bg-slate-50 border border-slate-300 rounded-lg p-2.5 w-full text-sm">
            </div>
        </div>
    </div>

</div>