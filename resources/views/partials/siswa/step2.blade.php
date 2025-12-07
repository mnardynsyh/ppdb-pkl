@php
    $orangTuaAyah = $siswa->orangTua->where('hubungan', 'Ayah')->first();
    $orangTuaIbu  = $siswa->orangTua->where('hubungan', 'Ibu')->first();
    $orangTuaWali = $siswa->orangTua->where('hubungan', 'Wali')->first();
@endphp

<div x-show="step === 2" class="space-y-8 animate-fade-in"
     x-data="{
        showWali: {{ old('tinggal_dengan_wali', $orangTuaWali ? 'true' : 'false') }},
        pekerjaanAyah: '{{ old('pekerjaan_ayah', $orangTuaAyah->pekerjaan ?? '') }}',
        pekerjaanIbu: '{{ old('pekerjaan_ibu', $orangTuaIbu->pekerjaan ?? '') }}',
        pekerjaanWali: '{{ old('pekerjaan_wali', $orangTuaWali->pekerjaan ?? '') }}',
     }">

    {{-- AYAH --}}
    <div class="bg-neutral-50/50 p-6 rounded-2xl border border-neutral-100">
        <h3 class="text-lg font-bold text-neutral-900 mb-6 flex items-center gap-2">
            <span class="w-10 h-10 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center">
                <i class="fa-solid fa-user-tie"></i>
            </span>
            Data Ayah Kandung
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Ayah --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Nama Lengkap</label>
                <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $orangTuaAyah->nama_lengkap ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" required {{ $isLocked ? 'disabled' : '' }}>
                @error('nama_ayah') <p class="mt-1 text-xs text-rose-600 font-bold">{{ $message }}</p> @enderror
            </div>

            {{-- NIK Ayah --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">NIK</label>
                <input type="text" inputmode="numeric" name="nik_ayah" maxlength="16" value="{{ old('nik_ayah', $orangTuaAyah->nik ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white font-mono" placeholder="16 Digit" required {{ $isLocked ? 'disabled' : '' }}>
                @error('nik_ayah') <p class="mt-1 text-xs text-rose-600 font-bold">{{ $message }}</p> @enderror
            </div>

            {{-- Tempat Lahir --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Tempat Lahir</label>
                <input type="text" name="tempat_lahir_ayah" value="{{ old('tempat_lahir_ayah', $orangTuaAyah->tempat_lahir ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" required {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- Tanggal Lahir --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir_ayah" value="{{ old('tanggal_lahir_ayah', !empty($orangTuaAyah->tanggal_lahir) ? \Carbon\Carbon::parse($orangTuaAyah->tanggal_lahir)->format('Y-m-d') : '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" required {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- Pendidikan --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Pendidikan Terakhir</label>
                <select name="pendidikan_ayah" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" required {{ $isLocked ? 'disabled' : '' }}>
                    <option value="">Pilih Pendidikan</option>
                    @foreach($pendidikanOptions ?? ['SD','SMP','SMA','D3','S1','S2','S3','Tidak Sekolah'] as $opt)
                        <option value="{{ $opt }}" {{ old('pendidikan_ayah', $orangTuaAyah->pendidikan_terakhir ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Pekerjaan --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Pekerjaan</label>
                <select name="pekerjaan_ayah" x-model="pekerjaanAyah" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" required {{ $isLocked ? 'disabled' : '' }}>
                    <option value="">Pilih Pekerjaan</option>
                    @foreach($pekerjaanOptions ?? ['PNS','TNI/Polri','Wiraswasta','Swasta','Petani','Nelayan','Buruh'] as $opt)
                        <option value="{{ $opt }}" {{ old('pekerjaan_ayah', $orangTuaAyah->pekerjaan ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Penghasilan --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Penghasilan Bulanan</label>
                <select name="penghasilan_ayah" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" required {{ $isLocked ? 'disabled' : '' }}>
                    <option value="">Pilih Penghasilan</option>
                    @foreach($penghasilanOptions ?? ['< 500.000','500.000 - 1.000.000','1.000.000 - 2.000.000','2.000.000 - 5.000.000','> 5.000.000'] as $opt)
                        <option value="{{ $opt }}" {{ old('penghasilan_ayah', $orangTuaAyah->penghasilan_bulanan ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>

            {{-- No HP --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Nomor HP/WA</label>
                <input type="text" name="no_hp_ayah" value="{{ old('no_hp_ayah', $orangTuaAyah->no_hp ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" placeholder="08xxxxxxxxxx" {{ $isLocked ? 'disabled' : '' }}>
            </div>
             {{-- Agama (Missing in layout, adding here) --}}
             <div class="md:col-span-2">
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Agama</label>
                <select name="agama_ayah" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" required {{ $isLocked ? 'disabled' : '' }}>
                    <option value="">Pilih Agama</option>
                    @foreach (['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                        <option value="{{ $agama }}" {{ old('agama_ayah', $orangTuaAyah->agama ?? '') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- IBU --}}
    <div class="bg-neutral-50/50 p-6 rounded-2xl border border-neutral-100">
        <h3 class="text-lg font-bold text-neutral-900 mb-6 flex items-center gap-2">
            <span class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center">
                <i class="fa-solid fa-user"></i>
            </span>
            Data Ibu Kandung
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Ibu --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Nama Lengkap</label>
                <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $orangTuaIbu->nama_lengkap ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" required {{ $isLocked ? 'disabled' : '' }}>
                @error('nama_ibu') <p class="mt-1 text-xs text-rose-600 font-bold">{{ $message }}</p> @enderror
            </div>
            
            {{-- NIK Ibu --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">NIK</label>
                <input type="text" name="nik_ibu" maxlength="16" value="{{ old('nik_ibu', $orangTuaIbu->nik ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white font-mono" required {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- Tempat Lahir --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Tempat Lahir</label>
                <input type="text" name="tempat_lahir_ibu" value="{{ old('tempat_lahir_ibu', $orangTuaIbu->tempat_lahir ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" required {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- Tanggal Lahir --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir_ibu" value="{{ old('tanggal_lahir_ibu', !empty($orangTuaIbu->tanggal_lahir) ? \Carbon\Carbon::parse($orangTuaIbu->tanggal_lahir)->format('Y-m-d') : '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" required {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- Pendidikan --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Pendidikan Terakhir</label>
                <select name="pendidikan_ibu" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" required {{ $isLocked ? 'disabled' : '' }}>
                    <option value="">Pilih Pendidikan</option>
                    @foreach($pendidikanOptions ?? ['SD','SMP','SMA','D3','S1','S2','S3','Tidak Sekolah'] as $opt)
                        <option value="{{ $opt }}" {{ old('pendidikan_ibu', $orangTuaIbu->pendidikan_terakhir ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Pekerjaan --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Pekerjaan</label>
                <select name="pekerjaan_ibu" x-model="pekerjaanIbu" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" required {{ $isLocked ? 'disabled' : '' }}>
                    <option value="">Pilih Pekerjaan</option>
                    @foreach($pekerjaanOptions ?? ['PNS','TNI/Polri','Wiraswasta','Swasta','Petani','Nelayan','Buruh'] as $opt)
                        <option value="{{ $opt }}" {{ old('pekerjaan_ibu', $orangTuaIbu->pekerjaan ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>

             {{-- Penghasilan --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Penghasilan Bulanan</label>
                <select name="penghasilan_ibu" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" required {{ $isLocked ? 'disabled' : '' }}>
                    <option value="">Pilih Penghasilan</option>
                    @foreach($penghasilanOptions ?? ['< 500.000','500.000 - 1.000.000','1.000.000 - 2.000.000','2.000.000 - 5.000.000','> 5.000.000'] as $opt)
                        <option value="{{ $opt }}" {{ old('penghasilan_ibu', $orangTuaIbu->penghasilan_bulanan ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>

            {{-- No HP --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Nomor HP/WA</label>
                <input type="text" name="no_hp_ibu" value="{{ old('no_hp_ibu', $orangTuaIbu->no_hp ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- Agama --}}
            <div class="md:col-span-2">
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Agama</label>
                <select name="agama_ibu" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" required {{ $isLocked ? 'disabled' : '' }}>
                    <option value="">Pilih Agama</option>
                    @foreach (['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                        <option value="{{ $agama }}" {{ old('agama_ibu', $orangTuaIbu->agama ?? '') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- WALI --}}
    <div>
        <div class="flex items-center gap-3 mb-6 p-4 bg-yellow-50 rounded-xl border border-yellow-100">
            <input id="waliCheck" type="checkbox" x-model="showWali" name="tinggal_dengan_wali" value="on"
                   class="w-5 h-5 text-primary-600 border-neutral-300 rounded focus:ring-primary-500 cursor-pointer">
            <label for="waliCheck" class="text-sm font-bold text-neutral-700 cursor-pointer">
                Saya tinggal dengan Wali (Bukan orang tua kandung)
            </label>
        </div>

        <div class="bg-neutral-50/50 p-6 rounded-2xl border border-neutral-100" x-show="showWali" x-transition>
            <h3 class="text-lg font-bold text-neutral-900 mb-6 flex items-center gap-2">
                <span class="w-10 h-10 rounded-full bg-neutral-200 text-neutral-600 flex items-center justify-center">
                    <i class="fa-solid fa-user-shield"></i>
                </span>
                Data Wali
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Gunakan pola input yang sama persis seperti Ayah/Ibu di sini untuk Wali --}}
                <div>
                    <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Nama Wali</label>
                    <input type="text" name="nama_wali" value="{{ old('nama_wali', $orangTuaWali->nama_lengkap ?? '') }}"
                           class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" {{ $isLocked ? 'disabled' : '' }}>
                </div>
                 <div>
                    <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">NIK</label>
                    <input type="text" name="nik_wali" value="{{ old('nik_wali', $orangTuaWali->nik ?? '') }}" maxlength="16"
                           class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white font-mono" {{ $isLocked ? 'disabled' : '' }}>
                </div>
                 <div>
                    <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir_wali" value="{{ old('tempat_lahir_wali', $orangTuaWali->tempat_lahir ?? '') }}"
                           class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" {{ $isLocked ? 'disabled' : '' }}>
                </div>
                <div>
                    <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir_wali" value="{{ old('tanggal_lahir_wali', !empty($orangTuaWali->tanggal_lahir) ? \Carbon\Carbon::parse($orangTuaWali->tanggal_lahir)->format('Y-m-d') : '') }}"
                           class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" {{ $isLocked ? 'disabled' : '' }}>
                </div>
                 <div>
                    <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Pendidikan</label>
                    <select name="pendidikan_wali" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" {{ $isLocked ? 'disabled' : '' }}>
                        <option value="">Pilih Pendidikan</option>
                        @foreach($pendidikanOptions ?? ['SD','SMP','SMA','D3','S1','S2','S3','Tidak Sekolah'] as $opt)
                            <option value="{{ $opt }}" {{ old('pendidikan_wali', $orangTuaWali->pendidikan_terakhir ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
                 <div>
                    <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Pekerjaan</label>
                    <select name="pekerjaan_wali" x-model="pekerjaanWali" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" {{ $isLocked ? 'disabled' : '' }}>
                        <option value="">Pilih Pekerjaan</option>
                         @foreach($pekerjaanOptions ?? ['PNS','TNI/Polri','Wiraswasta','Swasta','Petani','Nelayan','Buruh'] as $opt)
                            <option value="{{ $opt }}" {{ old('pekerjaan_wali', $orangTuaWali->pekerjaan ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
                 <div>
                    <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Penghasilan</label>
                    <select name="penghasilan_wali" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" {{ $isLocked ? 'disabled' : '' }}>
                        <option value="">Pilih Penghasilan</option>
                         @foreach($penghasilanOptions ?? ['< 500.000','500.000 - 1.000.000','1.000.000 - 2.000.000','2.000.000 - 5.000.000','> 5.000.000'] as $opt)
                            <option value="{{ $opt }}" {{ old('penghasilan_wali', $orangTuaWali->penghasilan_bulanan ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
                 <div>
                    <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Nomor HP/WA</label>
                    <input type="text" name="no_hp_wali" value="{{ old('no_hp_wali', $orangTuaWali->no_hp ?? '') }}"
                           class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" {{ $isLocked ? 'disabled' : '' }}>
                </div>
                <div class="md:col-span-2">
                    <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Agama</label>
                    <select name="agama_wali" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-white" {{ $isLocked ? 'disabled' : '' }}>
                         <option value="">Pilih Agama</option>
                        @foreach (['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                            <option value="{{ $agama }}" {{ old('agama_wali', $orangTuaWali->agama ?? '') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>