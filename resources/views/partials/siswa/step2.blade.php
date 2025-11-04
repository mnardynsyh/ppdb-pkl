<div x-show="step === 2" class="space-y-6 animate-fade-in"
     x-data="{ 
         showWali: {{ old('tinggal_dengan_wali', ($siswa->orangTuaWali && $siswa->orangTuaWali->nama_wali) ? 'true' : 'false') }},
         pekerjaanAyah: '{{ old('pekerjaan_ayah', $siswa->orangTuaWali->pekerjaan_ayah ?? '') }}',
         pekerjaanIbu: '{{ old('pekerjaan_ibu', $siswa->orangTuaWali->pekerjaan_ibu ?? '') }}',
         pekerjaanWali: '{{ old('pekerjaan_wali', $siswa->orangTuaWali->pekerjaan_wali ?? '') }}'
     }">

    <!-- ==================== DATA AYAH ==================== -->
    <div class="p-6 border rounded-lg shadow-sm">
        <h3 class="text-xl font-semibold text-slate-800 border-b pb-3 mb-6">Langkah 2: Data Ayah Kandung</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama_ayah" class="block mb-2 text-sm font-medium text-slate-900">Nama Lengkap Ayah</label>
                <input type="text" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah', $siswa->orangTuaWali->nama_ayah ?? '') }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" placeholder="Sesuai KTP" required>
                @error('nama_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="nik_ayah" class="block mb-2 text-sm font-medium text-slate-900">NIK Ayah</label>
                <input type="text" id="nik_ayah" name="nik_ayah" value="{{ old('nik_ayah', $siswa->orangTuaWali->nik_ayah ?? '') }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" placeholder="16 Digit NIK" required>
                @error('nik_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="tempat_lahir_ayah" class="block mb-2 text-sm font-medium text-slate-900">Tempat Lahir Ayah</label>
                <input type="text" id="tempat_lahir_ayah" name="tempat_lahir_ayah" value="{{ old('tempat_lahir_ayah', $siswa->orangTuaWali->tempat_lahir_ayah ?? '') }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                @error('tempat_lahir_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="tanggal_lahir_ayah" class="block mb-2 text-sm font-medium text-slate-900">Tanggal Lahir Ayah</label>
                <input type="date" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" value="{{ old('tanggal_lahir_ayah', $siswa->orangTuaWali->tanggal_lahir_ayah ?? '') }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                @error('tanggal_lahir_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="pendidikan_ayah" class="block mb-2 text-sm font-medium text-slate-900">Pendidikan Terakhir Ayah</label>
                <select id="pendidikan_ayah" name="pendidikan_ayah" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled {{ old('pendidikan_ayah', $siswa->orangTuaWali->pendidikan_ayah ?? '') ? '' : 'selected' }}>-- Pilih Pendidikan --</option>
                    @foreach($pendidikanOptions as $option)
                        <option value="{{ $option }}" @selected(old('pendidikan_ayah', $siswa->orangTuaWali->pendidikan_ayah ?? '') == $option)>{{ $option }}</option>
                    @endforeach
                </select>
                @error('pendidikan_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            
            <!-- Pekerjaan Ayah (enum + lainnya) -->
            <div>
                <label for="pekerjaan_ayah" class="block mb-2 text-sm font-medium text-slate-900">Pekerjaan Ayah</label>
                <select id="pekerjaan_ayah" name="pekerjaan_ayah" x-model="pekerjaanAyah"
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled selected>-- Pilih Pekerjaan --</option>
                    @foreach($pekerjaanOptions as $option)
                        <option value="{{ $option }}" @selected(old('pekerjaan_ayah', $siswa->orangTuaWali->pekerjaan_ayah ?? '') == $option)>{{ $option }}</option>
                    @endforeach
                </select>
                <div x-show="pekerjaanAyah === 'Lainnya'" x-transition>
                    <input type="text" name="pekerjaan_ayah_lainnya" placeholder="Tuliskan pekerjaan ayah..." 
                           value="{{ old('pekerjaan_ayah_lainnya', $siswa->orangTuaWali->pekerjaan_ayah_lainnya ?? '') }}"
                           class="mt-2 bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">
                </div>
                @error('pekerjaan_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="penghasilan_ayah" class="block mb-2 text-sm font-medium text-slate-900">Penghasilan Ayah</label>
                <select id="penghasilan_ayah" name="penghasilan_ayah" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled {{ old('penghasilan_ayah', $siswa->orangTuaWali->penghasilan_ayah ?? '') ? '' : 'selected' }}>-- Pilih Penghasilan --</option>
                    @foreach($penghasilanOptions as $option)
                        <option value="{{ $option }}" @selected(old('penghasilan_ayah', $siswa->orangTuaWali->penghasilan_ayah ?? '') == $option)>{{ $option }}</option>
                    @endforeach
                </select>
                @error('penghasilan_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="agama_ayah" class="block mb-2 text-sm font-medium text-slate-900">Agama Ayah</label>
                <select id="agama_ayah" name="agama_ayah" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled {{ old('agama_ayah', $siswa->orangTuaWali->agama_ayah ?? '') ? '' : 'selected' }}>-- Pilih Agama --</option>
                    @foreach($agamaOptions as $option)
                        <option value="{{ $option }}" @selected(old('agama_ayah', $siswa->orangTuaWali->agama_ayah ?? '') == $option)>{{ $option }}</option>
                    @endforeach
                </select>
                @error('agama_ayah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <!-- ==================== DATA IBU ==================== -->
    <div class="p-6 border rounded-lg shadow-sm">
        <h3 class="text-xl font-semibold text-slate-800 border-b pb-3 mb-6">Data Ibu Kandung</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama, TTL, Pendidikan -->
            <div>
                <label for="nama_ibu" class="block mb-2 text-sm font-medium text-slate-900">Nama Lengkap Ibu</label>
                <input type="text" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu', $siswa->orangTuaWali->nama_ibu ?? '') }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                @error('nama_ibu') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="nik_ibu" class="block mb-2 text-sm font-medium text-slate-900">NIK Ibu</label>
                <input type="text" id="nik_ibu" name="nik_ibu" value="{{ old('nik_ibu', $siswa->orangTuaWali->nik_ibu ?? '') }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                @error('nik_ibu') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="tempat_lahir_ibu" class="block mb-2 text-sm font-medium text-slate-900">Tempat Lahir Ibu</label>
                <input type="text" id="tempat_lahir_ibu" name="tempat_lahir_ibu" value="{{ old('tempat_lahir_ibu', $siswa->orangTuaWali->tempat_lahir_ibu ?? '') }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                @error('tempat_lahir_ibu') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="tanggal_lahir_ibu" class="block mb-2 text-sm font-medium text-slate-900">Tanggal Lahir Ibu</label>
                <input type="date" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu" value="{{ old('tanggal_lahir_ibu', $siswa->orangTuaWali->tanggal_lahir_ibu ?? '') }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                @error('tanggal_lahir_ibu') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Pendidikan & Pekerjaan -->
            <div>
                <label for="pendidikan_ibu" class="block mb-2 text-sm font-medium text-slate-900">Pendidikan Terakhir Ibu</label>
                <select id="pendidikan_ibu" name="pendidikan_ibu" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled {{ old('pendidikan_ibu', $siswa->orangTuaWali->pendidikan_ibu ?? '') ? '' : 'selected' }}>-- Pilih Pendidikan --</option>
                    @foreach($pendidikanOptions as $option)
                        <option value="{{ $option }}" @selected(old('pendidikan_ibu', $siswa->orangTuaWali->pendidikan_ibu ?? '') == $option)>{{ $option }}</option>
                    @endforeach
                </select>
                @error('pendidikan_ibu') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Pekerjaan Ibu (enum + lainnya) -->
            <div>
                <label for="pekerjaan_ibu" class="block mb-2 text-sm font-medium text-slate-900">Pekerjaan Ibu</label>
                <select id="pekerjaan_ibu" name="pekerjaan_ibu" x-model="pekerjaanIbu"
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled selected>-- Pilih Pekerjaan --</option>
                    @foreach($pekerjaanOptions as $option)
                        <option value="{{ $option }}" @selected(old('pekerjaan_ibu', $siswa->orangTuaWali->pekerjaan_ibu ?? '') == $option)>{{ $option }}</option>
                    @endforeach
                </select>
                <div x-show="pekerjaanIbu === 'Lainnya'" x-transition>
                    <input type="text" name="pekerjaan_ibu_lainnya" placeholder="Tuliskan pekerjaan ibu..."
                           value="{{ old('pekerjaan_ibu_lainnya', $siswa->orangTuaWali->pekerjaan_ibu_lainnya ?? '') }}"
                           class="mt-2 bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Penghasilan & Agama -->
            <div>
                <label for="penghasilan_ibu" class="block mb-2 text-sm font-medium text-slate-900">Penghasilan Ibu</label>
                <select id="penghasilan_ibu" name="penghasilan_ibu" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled {{ old('penghasilan_ibu', $siswa->orangTuaWali->penghasilan_ibu ?? '') ? '' : 'selected' }}>-- Pilih Penghasilan --</option>
                    @foreach($penghasilanOptions as $option)
                        <option value="{{ $option }}" @selected(old('penghasilan_ibu', $siswa->orangTuaWali->penghasilan_ibu ?? '') == $option)>{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="agama_ibu" class="block mb-2 text-sm font-medium text-slate-900">Agama Ibu</label>
                <select id="agama_ibu" name="agama_ibu" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled {{ old('agama_ibu', $siswa->orangTuaWali->agama_ibu ?? '') ? '' : 'selected' }}>-- Pilih Agama --</option>
                    @foreach($agamaOptions as $option)
                        <option value="{{ $option }}" @selected(old('agama_ibu', $siswa->orangTuaWali->agama_ibu ?? '') == $option)>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- ==================== DATA WALI (Opsional) ==================== -->
    <div class="p-6 border rounded-lg shadow-sm">
        <div class="flex items-center">
            <input id="showWali" name="tinggal_dengan_wali" type="checkbox" x-model="showWali" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
            <label for="showWali" class="ml-2 text-sm font-medium text-gray-900">Saya tinggal dengan Wali (centang jika perlu mengisi data wali).</label>
        </div>

        <div x-show="showWali" x-transition class="mt-6">
                        <h3 class="text-xl font-semibold text-slate-800 border-b pb-3 mb-6">Data Wali</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama_wali" class="block mb-2 text-sm font-medium text-slate-900">Nama Lengkap Wali</label>
                    <input type="text" id="nama_wali" name="nama_wali"
                        value="{{ old('nama_wali', $siswa->orangTuaWali->nama_wali ?? '') }}"
                        class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 
                        focus:ring-blue-500 focus:border-blue-500" placeholder="Sesuai KTP">
                    @error('nama_wali') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="nik_wali" class="block mb-2 text-sm font-medium text-slate-900">NIK Wali</label>
                    <input type="text" id="nik_wali" name="nik_wali"
                        value="{{ old('nik_wali', $siswa->orangTuaWali->nik_wali ?? '') }}"
                        class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 
                        focus:ring-blue-500 focus:border-blue-500" placeholder="16 Digit NIK">
                    @error('nik_wali') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="tempat_lahir_wali" class="block mb-2 text-sm font-medium text-slate-900">Tempat Lahir Wali</label>
                    <input type="text" id="tempat_lahir_wali" name="tempat_lahir_wali"
                        value="{{ old('tempat_lahir_wali', $siswa->orangTuaWali->tempat_lahir_wali ?? '') }}"
                        class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 
                        focus:ring-blue-500 focus:border-blue-500">
                    @error('tempat_lahir_wali') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="tanggal_lahir_wali" class="block mb-2 text-sm font-medium text-slate-900">Tanggal Lahir Wali</label>
                    <input type="date" id="tanggal_lahir_wali" name="tanggal_lahir_wali"
                        value="{{ old('tanggal_lahir_wali', $siswa->orangTuaWali->tanggal_lahir_wali ?? '') }}"
                        class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 
                        focus:ring-blue-500 focus:border-blue-500">
                    @error('tanggal_lahir_wali') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="pendidikan_wali" class="block mb-2 text-sm font-medium text-slate-900">Pendidikan Terakhir Wali</label>
                    <select id="pendidikan_wali" name="pendidikan_wali"
                        class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 
                        focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled {{ old('pendidikan_wali', $siswa->orangTuaWali->pendidikan_wali ?? '') ? '' : 'selected' }}>
                            -- Pilih Pendidikan --
                        </option>
                        @foreach($pendidikanOptions as $option)
                            <option value="{{ $option }}" 
                                @selected(old('pendidikan_wali', $siswa->orangTuaWali->pendidikan_wali ?? '') == $option)>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                    @error('pendidikan_wali') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Pekerjaan Wali (enum + Lainnya) -->
                <div>
                    <label for="pekerjaan_wali" class="block mb-2 text-sm font-medium text-slate-900">Pekerjaan Wali</label>
                    <select id="pekerjaan_wali" name="pekerjaan_wali" x-model="pekerjaanWali"
                        class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 
                        focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>-- Pilih Pekerjaan --</option>
                        @foreach($pekerjaanOptions as $option)
                            <option value="{{ $option }}" 
                                @selected(old('pekerjaan_wali', $siswa->orangTuaWali->pekerjaan_wali ?? '') == $option)>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                    <div x-show="pekerjaanWali === 'Lainnya'" x-transition>
                        <input type="text" name="pekerjaan_wali_lainnya" placeholder="Tuliskan pekerjaan wali..."
                               value="{{ old('pekerjaan_wali_lainnya', $siswa->orangTuaWali->pekerjaan_wali_lainnya ?? '') }}"
                               class="mt-2 bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 
                               focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    @error('pekerjaan_wali') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="penghasilan_wali" class="block mb-2 text-sm font-medium text-slate-900">Penghasilan Wali</label>
                    <select id="penghasilan_wali" name="penghasilan_wali"
                        class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 
                        focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled {{ old('penghasilan_wali', $siswa->orangTuaWali->penghasilan_wali ?? '') ? '' : 'selected' }}>
                            -- Pilih Penghasilan --
                        </option>
                        @foreach($penghasilanOptions as $option)
                            <option value="{{ $option }}" 
                                @selected(old('penghasilan_wali', $siswa->orangTuaWali->penghasilan_wali ?? '') == $option)>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                    @error('penghasilan_wali') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="agama_wali" class="block mb-2 text-sm font-medium text-slate-900">Agama Wali</label>
                    <select id="agama_wali" name="agama_wali"
                        class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg block w-full p-2.5 
                        focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled {{ old('agama_wali', $siswa->orangTuaWali->agama_wali ?? '') ? '' : 'selected' }}>
                            -- Pilih Agama --
                        </option>
                        @foreach($agamaOptions as $option)
                            <option value="{{ $option }}" 
                                @selected(old('agama_wali', $siswa->orangTuaWali->agama_wali ?? '') == $option)>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                    @error('agama_wali') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

