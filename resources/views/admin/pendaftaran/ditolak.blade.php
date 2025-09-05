@extends('layouts.admin')

@section('title', 'Pendaftar Ditolak')

@section('content')
<div class="p-4 mt-12">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Daftar Siswa Ditolak
        </h1>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded border border-green-200 bg-green-50 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Pendaftar Ditolak --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-300">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-6 py-3 w-16">No</th>
                    <th class="px-6 py-3">Nama Lengkap</th>
                    <th class="px-6 py-3">NISN</th>
                    <th class="px-6 py-3">Asal Sekolah</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $i => $siswa)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 font-semibold">{{ $siswa->nama_lengkap }}</td>
                        <td class="px-6 py-4">{{ $siswa->nisn }}</td>
                        <td class="px-6 py-4">{{ $siswa->asal_sekolah }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="#" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    Detail
                                </a>
                                <form action="{{ route('admin.pendaftaran.kembalikan', $siswa) }}" method="POST"
                                      onsubmit="return confirm('Batalkan status DITOLAK dan kembalikan ke Pending?')">
                                    @csrf
                                    <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">
                                        Batalkan
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-6 text-center text-gray-500 dark:text-gray-400" colspan="5">
                            Belum ada siswa yang ditolak.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
