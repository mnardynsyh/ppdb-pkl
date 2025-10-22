<div x-show="step === 1" class="space-y-8 animate-fade-in" x-data="addressHandler">
    
    {{-- === Bagian Data Diri === --}}
    <div>
        <h3 class="text-xl font-semibold text-slate-800 border-b pb-3 mb-6">Langkah 1: Data Diri Calon Siswa</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-slate-900">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Sesuai Akta Kelahiran" required>
                @error('nama_lengkap') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="nik" class="block mb-2 text-sm font-medium text-slate-900">NIK (Nomor Induk Kependudukan)</label>
                <input type="text" id="nik" name="nik" value="{{ old('nik', $siswa->nik) }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="16 Digit NIK" required>
                @error('nik') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="nisn" class="block mb-2 text-sm font-medium text-slate-900">NISN (Nomor Induk Siswa Nasional)</label>
                <input type="text" id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="10 Digit NISN" required>
                @error('nisn') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-slate-900">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option value="" disabled {{ old('jenis_kelamin', $siswa->jenis_kelamin) ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                    <option value="L" @if(old('jenis_kelamin', $siswa->jenis_kelamin) == 'L') selected @endif>Laki-laki</option>
                    <option value="P" @if(old('jenis_kelamin', $siswa->jenis_kelamin) == 'P') selected @endif>Perempuan</option>
                </select>
                @error('jenis_kelamin') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-slate-900">Tempat Lahir</label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Kota Kelahiran" required>
                @error('tempat_lahir') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-slate-900">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('Y-m-d') : '') }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                @error('tanggal_lahir') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="agama" class="block mb-2 text-sm font-medium text-slate-900">Agama</label> {{-- [DIUBAH] label for disesuaikan --}}
                {{-- [DIUBAH] name="agama", id="agama" --}}
                <select id="agama" name="agama" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option value="" disabled {{ old('agama', $siswa->agama) ? '' : 'selected' }}>Pilih Agama</option> {{-- Kondisi old() disesuaikan --}}
                    {{-- [DIUBAH] Looping menggunakan $agamaOptions --}}
                    @foreach($agamaOptions as $option) 
                        {{-- [DIUBAH] value="$option", kondisi selected disesuaikan --}}
                        <option value="{{ $option }}" @if(old('agama', $siswa->agama) == $option) selected @endif>{{ $option }}</option>
                    @endforeach
                </select>
                @error('agama') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror {{-- Error key disesuaikan --}}
            </div>
             <div>
                <label for="anak_ke" class="block mb-2 text-sm font-medium text-slate-900">Anak Ke-</label>
                <input type="number" id="anak_ke" name="anak_ke" value="{{ old('anak_ke', $siswa->anak_ke) }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Contoh: 1">
                @error('anak_ke') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    {{-- === Bagian Alamat === --}}
    <div>
        <h3 class="text-lg font-semibold text-slate-800 border-b pb-3 mb-6">Alamat Tempat Tinggal</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Dropdown Provinsi --}}
            <div>
                <label for="provinsi_id" class="block mb-2 text-sm font-medium text-slate-900">Provinsi</label>
                <select id="provinsi_id" name="provinsi_id" x-model="selectedProvince" @change="fetchRegencies()" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">-- Pilih Provinsi --</option>
                    <template x-for="province in provinces" :key="province.id">
                        <option :value="province.id" x-text="province.name" :selected="province.id == selectedProvince"></option>
                    </template>
                </select>
                @error('provinsi_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Dropdown Kabupaten/Kota --}}
            <div>
                <label for="kabupaten_id" class="block mb-2 text-sm font-medium text-slate-900">Kabupaten/Kota</label>
                <select id="kabupaten_id" name="kabupaten_id" x-model="selectedRegency" @change="fetchDistricts()" :disabled="!selectedProvince" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 disabled:bg-slate-200">
                    <option value="">-- Pilih Kabupaten/Kota --</option>
                    <template x-for="regency in regencies" :key="regency.id">
                        <option :value="regency.id" x-text="regency.name" :selected="regency.id == selectedRegency"></option>
                    </template>
                </select>
                @error('kabupaten_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            
            {{-- Dropdown Kecamatan --}}
            <div>
                <label for="kecamatan_id" class="block mb-2 text-sm font-medium text-slate-900">Kecamatan</label>
                <select id="kecamatan_id" name="kecamatan_id" x-model="selectedDistrict" :disabled="!selectedRegency" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 disabled:bg-slate-200">
                    <option value="">-- Pilih Kecamatan --</option>
                    <template x-for="district in districts" :key="district.id">
                        <option :value="district.id" x-text="district.name" :selected="district.id == selectedDistrict"></option>
                    </template>
                </select>
                @error('kecamatan_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Alamat Lengkap --}}
            <div class="md:col-span-2">
                <label for="alamat" class="block mb-2 text-sm font-medium text-slate-900">Nama Jalan, RT/RW, dan Kelurahan/Desa</label>
                <textarea id="alamat" name="alamat" rows="3" class="block p-2.5 w-full text-sm text-slate-900 bg-slate-50 rounded-lg border border-slate-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Jl. Merdeka No. 10, RT 01/RW 05, Kelurahan Bahagia" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                @error('alamat') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>
</div>

