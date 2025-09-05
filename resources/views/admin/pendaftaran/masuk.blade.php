@extends('layouts.admin')

@section('title', 'Pendaftaran Masuk')

@section('content')
<div class="p-4 mt-12">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Verifikasi Pendaftar Baru
        </h1>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded border border-green-200 bg-green-50 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Pendaftar --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-300">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-6 py-3 w-16">No</th>
                    <th class="px-6 py-3">Nama Lengkap</th>
                    <th class="px-6 py-3">NISN</th>
                    <th class="px-6 py-3">Asal Sekolah</th>
                    <th class="px-6 py-3">Tanggal Daftar</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $i => $siswa)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        {{-- [FIX] Memperbaiki penomoran agar sesuai dengan paginasi --}}
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ $siswas->firstItem() + $i }}</td>
                        <td class="px-6 py-4 font-semibold">{{ $siswa->nama_lengkap }}</td>
                        <td class="px-6 py-4">{{ $siswa->nisn }}</td>
                        <td class="px-6 py-4">{{ $siswa->asal_sekolah }}</td>
                        <td class="px-6 py-4">{{ $siswa->created_at->isoFormat('D MMMM YYYY') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                {{-- [FIX] Mengarahkan tombol detail ke route yang benar --}}
                                <a href="{{ route('admin.pendaftaran.detail', $siswa) }}" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                                    Detail
                                </a>
                                
                                {{-- [FIX] Mengubah route dari 'diterima' ke 'terima' dan menambahkan @method('PATCH') --}}
                                <form action="{{ route('admin.pendaftaran.terima', $siswa) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin MENERIMA pendaftar ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                                        Terima
                                    </button>
                                </form>
                                
                                {{-- [FIX] Menambahkan @method('PATCH') --}}
                                <form action="{{ route('admin.pendaftaran.tolak', $siswa) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin MENOLAK pendaftar ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-6 text-center text-gray-500 dark:text-gray-400" colspan="6">
                            Belum ada pendaftar baru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- [FIX] Menambahkan link untuk paginasi --}}
    <div class="mt-4">
        {{ $siswas->links() }}
    </div>
</div>
@endsection

