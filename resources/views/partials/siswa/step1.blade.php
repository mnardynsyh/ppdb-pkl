<div x-show="step === 1" class="space-y-6 animate-fade-in">
    <h3 class="text-xl font-semibold text-gray-800 border-b pb-2">Langkah 1: Data Diri Calon Siswa</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Sesuai Akta Kelahiran" required>
        </div>
        <div>
            <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">NIK (Nomor Induk Kependudukan)</label>
            <input type="text" id="nik" name="nik" value="{{ old('nik', $siswa->nik) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="16 Digit NIK" required>
        </div>
        <div>
            <label for="nisn" class="block mb-2 text-sm font-medium text-gray-900">NISN (Nomor Induk Siswa Nasional)</label>
            <input type="text" id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="10 Digit NISN" required>
        </div>
        <div>
            <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                <option value="" disabled>Pilih Jenis Kelamin</option>
                <option value="L" @if(old('jenis_kelamin', $siswa->jenis_kelamin) == 'L') selected @endif>Laki-laki</option>
                <option value="P" @if(old('jenis_kelamin', $siswa->jenis_kelamin) == 'P') selected @endif>Perempuan</option>
            </select>
        </div>
        <div>
            <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tempat Lahir</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Kota Kelahiran" required>
        </div>
        <div>
            <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('Y-m-d') : '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>
        <div>
            <label for="agama_id" class="block mb-2 text-sm font-medium text-gray-900">Agama</label>
            <select id="agama_id" name="agama_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                <option value="" disabled>Pilih Agama</option>
                @foreach($agamas as $agama)
                    <option value="{{ $agama->id }}" @if(old('agama_id', $siswa->agama_id) == $agama->id) selected @endif>{{ $agama->agama }}</option>
                @endforeach
            </select>
        </div>
         <div>
            <label for="anak_ke" class="block mb-2 text-sm font-medium text-gray-900">Anak Ke-</label>
            <input type="number" id="anak_ke" name="anak_ke" value="{{ old('anak_ke', $siswa->anak_ke) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Contoh: 1">
        </div>
        <div class="md:col-span-2">
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat Lengkap</label>
            <textarea id="alamat" name="alamat" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Sesuai Kartu Keluarga" required>{{ old('alamat', $siswa->alamat) }}</textarea>
        </div>
    </div>
</div>

