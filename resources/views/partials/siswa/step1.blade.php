<div x-show="step === 1" class="space-y-8 animate-fade-in" x-data="addressHandler({{ $provinsi->toJson() }})">

    {{-- Group: Identitas --}}
    <div>
        <h3 class="text-lg font-bold text-neutral-900 border-b border-neutral-100 pb-3 mb-6 flex items-center gap-2">
            <span class="w-1.5 h-6 bg-primary-500 rounded-full"></span> Data Diri Calon Siswa
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Lengkap --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 focus:bg-white transition-all disabled:bg-neutral-100 disabled:text-neutral-500"
                       placeholder="Masukkan nama lengkap sesuai ijazah/akta"
                       required {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- NIK --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">NIK</label>
                <input type="text" name="nik" value="{{ old('nik', $siswa->nik) }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 focus:bg-white font-mono disabled:bg-neutral-100 disabled:text-neutral-500"
                       placeholder="16 digit Nomor Induk Kependudukan"
                       required {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- NISN --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">NISN</label>
                <input type="text" name="nisn" value="{{ old('nisn', $siswa->nisn) }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 focus:bg-white font-mono disabled:bg-neutral-100 disabled:text-neutral-500"
                       placeholder="10 digit Nomor Induk Siswa Nasional"
                       required {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- Jenis Kelamin --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Jenis Kelamin</label>
                <div class="relative">
                    <select name="jenis_kelamin" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 focus:bg-white appearance-none cursor-pointer disabled:bg-neutral-100 disabled:text-neutral-500" required {{ $isLocked ? 'disabled' : '' }}>
                        <option value="" disabled {{ old('jenis_kelamin', $siswa->jenis_kelamin) ? '' : 'selected' }}>-- Pilih Jenis Kelamin --</option>
                        <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            {{-- Tempat Lahir --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 focus:bg-white disabled:bg-neutral-100 disabled:text-neutral-500"
                       placeholder="Kota/Kabupaten kelahiran"
                       required {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- Tanggal Lahir --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('Y-m-d') : '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 focus:bg-white disabled:bg-neutral-100 disabled:text-neutral-500"
                       required {{ $isLocked ? 'disabled' : '' }}>
            </div>

            {{-- Agama --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Agama</label>
                <div class="relative">
                    <select name="agama" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 focus:bg-white appearance-none cursor-pointer disabled:bg-neutral-100 disabled:text-neutral-500" required {{ $isLocked ? 'disabled' : '' }}>
                        <option value="" disabled {{ old('agama', $siswa->agama) ? '' : 'selected' }}>-- Pilih Agama --</option>
                        @foreach ($agamaOptions as $option)
                            <option value="{{ $option }}" {{ old('agama', $siswa->agama) == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Anak Ke --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Anak Ke-</label>
                <input type="number" name="anak_ke" value="{{ old('anak_ke', $siswa->anak_ke) }}"
                       class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 focus:bg-white disabled:bg-neutral-100 disabled:text-neutral-500"
                       placeholder="Contoh: 1" min="1" max="20"
                       {{ $isLocked ? 'disabled' : '' }}>
            </div>
        </div>
    </div>

    {{-- Group: Alamat --}}
    <div>
        <h3 class="text-lg font-bold text-neutral-900 border-b border-neutral-100 pb-3 mb-6 flex items-center gap-2 mt-8">
            <span class="w-1.5 h-6 bg-primary-500 rounded-full"></span> Alamat Domisili
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Provinsi --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Provinsi</label>
                <div class="relative">
                    <select name="provinsi_id" x-model="selectedProvince" @change="fetchRegencies()"
                            class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 focus:bg-white appearance-none cursor-pointer disabled:bg-neutral-100 disabled:text-neutral-400"
                            required {{ $isLocked ? 'disabled' : '' }}>
                        <option value="">-- Pilih Provinsi --</option>
                        <template x-for="province in provinces" :key="province.id">
                            <option :value="province.id" x-text="province.nama" :selected="province.id == selectedProvince"></option>
                        </template>
                    </select>
                </div>
            </div>

            {{-- Kabupaten --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Kabupaten/Kota</label>
                <div class="relative">
                    <select name="kabupaten_id" x-model="selectedRegency" @change="fetchDistricts()" 
                            :disabled="!selectedProvince || {{ $isLocked ? 'true' : 'false' }}"
                            class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 focus:bg-white disabled:bg-neutral-100 disabled:text-neutral-400 appearance-none cursor-pointer"
                            required>
                        <option value="">-- Pilih Kabupaten --</option>
                        <template x-for="regency in regencies" :key="regency.id">
                            <option :value="regency.id" x-text="regency.nama" :selected="regency.id == selectedRegency"></option>
                        </template>
                    </select>
                </div>
            </div>

            {{-- Kecamatan --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Kecamatan</label>
                <div class="relative">
                    <select name="kecamatan_id" x-model="selectedDistrict" @change="fetchVillages()" 
                            :disabled="!selectedRegency || {{ $isLocked ? 'true' : 'false' }}"
                            class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 focus:bg-white disabled:bg-neutral-100 disabled:text-neutral-400 appearance-none cursor-pointer"
                            required>
                        <option value="">-- Pilih Kecamatan --</option>
                        <template x-for="district in districts" :key="district.id">
                            <option :value="district.id" x-text="district.nama" :selected="district.id == selectedDistrict"></option>
                        </template>
                    </select>
                </div>
            </div>

            {{-- Desa --}}
            <div>
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Desa/Kelurahan</label>
                <div class="relative">
                    <select name="desa_id" x-model="selectedVillage" 
                            :disabled="!selectedDistrict || {{ $isLocked ? 'true' : 'false' }}"
                            class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 focus:bg-white disabled:bg-neutral-100 disabled:text-neutral-400 appearance-none cursor-pointer"
                            required>
                        <option value="">-- Pilih Desa --</option>
                        <template x-for="village in villages" :key="village.id">
                            <option :value="village.id" x-text="village.nama" :selected="village.id == selectedVillage"></option>
                        </template>
                    </select>
                </div>
            </div>

            {{-- Alamat Detail --}}
            <div class="md:col-span-2">
                <label class="block mb-2 text-xs font-bold text-neutral-500 uppercase tracking-wider">Nama Jalan, RT/RW</label>
                <textarea name="alamat" rows="2"
                          class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 bg-neutral-50 focus:bg-white disabled:bg-neutral-100 disabled:text-neutral-500 resize-none"
                          placeholder="Contoh: Jl. Merdeka No. 10, RT 01/RW 02"
                          required {{ $isLocked ? 'disabled' : '' }}>{{ old('alamat', $siswa->alamat) }}</textarea>
            </div>
        </div>
    </div>
</div>