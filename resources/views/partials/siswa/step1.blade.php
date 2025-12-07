<div x-show="step === 1" class="space-y-8 animate-fade-in" x-data="addressHandler({{ $provinsi->toJson() }})">

    {{-- Group: Identitas --}}
    <div>
        <h3 class="text-lg font-bold text-neutral-900 border-b border-neutral-100 pb-3 mb-6 flex items-center gap-2">
            <span class="w-1.5 h-6 bg-primary-500 rounded-full"></span>
            Data Diri Calon Siswa
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Lengkap --}}
            <div>
                <label for="nama_lengkap" class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all placeholder-neutral-400 bg-neutral-50 focus:bg-white"
                       placeholder="Sesuai Akta Kelahiran" required {{ $isLocked ? 'disabled' : '' }}>
                @error('nama_lengkap') <p class="mt-1 text-xs text-rose-600 font-bold">{{ $message }}</p> @enderror
            </div>

            {{-- NIK --}}
            <div>
                <label for="nik" class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">NIK</label>
                <input type="text" id="nik" name="nik" value="{{ old('nik', $siswa->nik) }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all placeholder-neutral-400 bg-neutral-50 focus:bg-white font-mono"
                       placeholder="16 Digit Angka" required {{ $isLocked ? 'disabled' : '' }}>
                @error('nik') <p class="mt-1 text-xs text-rose-600 font-bold">{{ $message }}</p> @enderror
            </div>

            {{-- NISN --}}
            <div>
                <label for="nisn" class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">NISN</label>
                <input type="text" id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn) }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all placeholder-neutral-400 bg-neutral-50 focus:bg-white font-mono"
                       placeholder="10 Digit Angka" required {{ $isLocked ? 'disabled' : '' }}>
                @error('nisn') <p class="mt-1 text-xs text-rose-600 font-bold">{{ $message }}</p> @enderror
            </div>

            {{-- Jenis Kelamin --}}
            <div>
                <label for="jenis_kelamin" class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Jenis Kelamin</label>
                <div class="relative ">
                    <select id="jenis_kelamin" name="jenis_kelamin" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all bg-neutral-50 focus:bg-white appearance-none cursor-pointer" required {{ $isLocked ? 'disabled' : '' }}>
                        <option value="" disabled {{ old('jenis_kelamin', $siswa->jenis_kelamin) ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            {{-- Tempat Lahir --}}
            <div>
                <label for="tempat_lahir" class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Tempat Lahir</label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all placeholder-neutral-400 bg-neutral-50 focus:bg-white" required {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- Tanggal Lahir --}}
            <div>
                <label for="tanggal_lahir" class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('Y-m-d') : '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all bg-neutral-50 focus:bg-white" required {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- Agama --}}
            <div>
                <label for="agama" class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Agama</label>
                <div class="relative">
                    <select id="agama" name="agama" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all bg-neutral-50 focus:bg-white appearance-none cursor-pointer" required {{ $isLocked ? 'disabled' : '' }}>
                        <option value="" disabled {{ old('agama', $siswa->agama) ? '' : 'selected' }}>Pilih Agama</option>
                        @foreach ($agamaOptions as $option)
                            <option value="{{ $option }}" {{ old('agama', $siswa->agama) == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Anak Ke --}}
            <div>
                <label for="anak_ke" class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Anak Ke-</label>
                <input type="number" id="anak_ke" name="anak_ke" value="{{ old('anak_ke', $siswa->anak_ke) }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all placeholder-neutral-400 bg-neutral-50 focus:bg-white"
                       placeholder="Contoh: 1" min="1" max="20" {{ $isLocked ? 'disabled' : '' }}>
            </div>
        </div>
    </div>

    {{-- Group: Alamat --}}
    <div>
        <h3 class="text-lg font-bold text-neutral-900 border-b border-neutral-100 pb-3 mb-6 flex items-center gap-2 mt-8">
            <span class="w-1.5 h-6 bg-primary-500 rounded-full"></span>
            Alamat Domisili
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Provinsi --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Provinsi</label>
                <select name="provinsi_id" x-model="selectedProvince" @change="fetchRegencies()"
                        class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 disabled:bg-neutral-100 disabled:text-neutral-500 disabled:cursor-not-allowed"
                        required {{ $isLocked ? 'disabled' : '' }}>
                    <option value="">-- Pilih Provinsi --</option>
                    <template x-for="province in provinces" :key="province.id">
                        <option :value="province.id" x-text="province.nama" :selected="province.id == selectedProvince"></option>
                    </template>
                </select>
            </div>

            {{-- Kabupaten --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Kabupaten/Kota</label>
                <select name="kabupaten_id" x-model="selectedRegency" @change="fetchDistricts()"
                        class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 disabled:bg-neutral-100 disabled:text-neutral-500 disabled:cursor-not-allowed"
                        required {{ $isLocked ? 'disabled' : '' }}>
                    <option value="">-- Pilih Kabupaten --</option>
                    <template x-for="regency in regencies" :key="regency.id">
                        <option :value="regency.id" x-text="regency.nama" :selected="regency.id == selectedRegency"></option>
                    </template>
                </select>
            </div>

            {{-- Kecamatan --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Kecamatan</label>
                <select name="kecamatan_id" x-model="selectedDistrict" @change="fetchVillages()"
                        class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 disabled:bg-neutral-100 disabled:text-neutral-500 disabled:cursor-not-allowed"
                        required {{ $isLocked ? 'disabled' : '' }}>
                    <option value="">-- Pilih Kecamatan --</option>
                    <template x-for="district in districts" :key="district.id">
                        <option :value="district.id" x-text="district.nama" :selected="district.id == selectedDistrict"></option>
                    </template>
                </select>
            </div>

            {{-- Desa --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Desa/Kelurahan</label>
                <select name="desa_id" x-model="selectedVillage"
                        class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 disabled:bg-neutral-100 disabled:text-neutral-500 disabled:cursor-not-allowed"
                        required {{ $isLocked ? 'disabled' : '' }}>
                    <option value="">-- Pilih Desa --</option>
                    <template x-for="village in villages" :key="village.id">
                        <option :value="village.id" x-text="village.nama" :selected="village.id == selectedVillage"></option>
                    </template>
                </select>
            </div>

            {{-- Alamat Detail --}}
            <div class="md:col-span-2">
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Nama Jalan, RT/RW</label>
                <textarea name="alamat" rows="2"
                          class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 disabled:bg-neutral-100 disabled:text-neutral-500 disabled:cursor-not-allowed resize-none"
                          required {{ $isLocked ? 'disabled' : '' }}>{{ old('alamat', $siswa->alamat) }}</textarea>
            </div>
        </div>
    </div>
</div>