@extends('layouts.wali') 

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Input Data Siswa</h2>

    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('wali.input-siswa.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Data Siswa --}}
        <h3 class="text-lg font-semibold">Data Siswa</h3>
        <div>
            <label class="block mb-2 text-sm font-medium">Nama Siswa</label>
            <input type="text" name="nama_siswa" class="block w-full rounded-lg border-gray-300" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-2 text-sm font-medium">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="block w-full rounded-lg border-gray-300" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="block w-full rounded-lg border-gray-300" required>
            </div>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="block w-full rounded-lg border-gray-300" required>
                <option value="">-- Pilih --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium">Alamat</label>
            <textarea name="alamat" class="block w-full rounded-lg border-gray-300"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-2 text-sm font-medium">Pendidikan</label>
                <select name="id_pendidikan" class="block w-full rounded-lg border-gray-300">
                    <option value="">-- Pilih --</option>
                    @foreach($pendidikan as $p)
                        <option value="{{ $p->id }}">{{ $p->pendidikan }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium">Pekerjaan</label>
                <select name="id_pekerjaan" class="block w-full rounded-lg border-gray-300">
                    <option value="">-- Pilih --</option>
                    @foreach($pekerjaan as $p)
                        <option value="{{ $p->id }}">{{ $p->pekerjaan }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-2 text-sm font-medium">Penghasilan</label>
                <select name="id_penghasilan" class="block w-full rounded-lg border-gray-300">
                    <option value="">-- Pilih --</option>
                    @foreach($penghasilan as $p)
                        <option value="{{ $p->id }}">{{ $p->penghasilan }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium">Agama</label>
                <select name="id_agama" class="block w-full rounded-lg border-gray-300">
                    <option value="">-- Pilih --</option>
                    @foreach($agama as $a)
                        <option value="{{ $a->id }}">{{ $a->agama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Dokumen Siswa --}}
        <h3 class="text-lg font-semibold pt-4">Upload Dokumen Siswa</h3>
        <div>
            <label class="block mb-2 text-sm font-medium">Jenis Dokumen</label>
            <select name="jenis_dokumen" class="block w-full rounded-lg border-gray-300" required>
                <option value="">-- Pilih --</option>
                @foreach($jenisDokumen as $jenis)
                    <option value="{{ $jenis }}">{{ $jenis }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium">File Dokumen</label>
            <input type="file" name="file_dokumen" class="block w-full rounded-lg border-gray-300" required>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium">Keterangan (Opsional)</label>
            <input type="text" name="keterangan" class="block w-full rounded-lg border-gray-300">
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Simpan</button>
    </form>
</div>
@endsection
