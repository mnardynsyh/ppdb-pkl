@extends('layouts.admin')

@section('title', 'Semua Pendaftar')

@section('content')
<div class="p-4 sm:p-6 mt-12">
    {{-- Header Halaman --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Semua Data Pendaftar
        </h1>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Card Filter dan Pencarian --}}
    <div class="mb-6 p-4 bg-white dark:bg-gray-800 rounded-xl shadow-md">
        <form action="{{ route('admin.pendaftaran.semua') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="lg:col-span-2 relative">
                <label for="search" class="sr-only">Cari</label>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" id="search" placeholder="Cari nama, NISN, atau asal sekolah..."
                       value="{{ request('search') }}"
                       class="w-full pl-10 rounded-lg border-gray-300 p-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label for="status" class="sr-only">Status</label>
                <select name="status" id="status" class="w-full rounded-lg border-gray-300 p-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="">Semua Status</option>
                    <option value="Pending" @selected(request('status') == 'Pending')>Pending</option>
                    <option value="Diterima" @selected(request('status') == 'Diterima')>Diterima</option>
                    <option value="Ditolak" @selected(request('status') == 'Ditolak')>Ditolak</option>
                </select>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition duration-300">
                    Filter
                </button>
                <a href="{{ route('admin.pendaftaran.export', request()->query()) }}" class="w-full px-4 py-2 text-center text-white bg-green-600 rounded-lg shadow hover:bg-green-700 transition duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>Ekspor</span>
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
        <div class="hidden md:block">
            <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Nama Lengkap</th>
                        <th class="px-6 py-3">NISN</th>
                        <th class="px-6 py-3">Asal Sekolah</th>
                        <th class="px-6 py-3 text-center">Status</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswas as $siswa)
                        <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-800 dark:even:bg-gray-700/50 border-t dark:border-gray-700">
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ $siswa->nama_lengkap }}</td>
                            <td class="px-6 py-4">{{ $siswa->nisn }}</td>
                            <td class="px-6 py-4">{{ $siswa->asal_sekolah }}</td>
                            <td class="px-6 py-4 text-center">
                                <span @class([
                                    'px-2.5 py-1 text-xs font-semibold rounded-full',
                                    'bg-yellow-100 text-yellow-800' => $siswa->status_pendaftaran == 'Pending',
                                    'bg-green-100 text-green-800' => $siswa->status_pendaftaran == 'Diterima',
                                    'bg-red-100 text-red-800' => $siswa->status_pendaftaran == 'Ditolak',
                                ])>
                                    {{ $siswa->status_pendaftaran }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.pendaftaran.detail', $siswa)}}" title="Lihat Detail" class="p-2 text-white bg-indigo-500 hover:bg-indigo-600 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    @if ($siswa->status_pendaftaran == 'Pending')
                                        <form action="{{ route('admin.pendaftaran.terima', $siswa) }}" method="POST" onsubmit="return confirm('Yakin ingin menerima siswa ini?')">@csrf @method('PATCH')
                                            <button type="submit" title="Terima" class="p-2 text-white bg-green-500 hover:bg-green-600 rounded-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.pendaftaran.tolak', $siswa) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak siswa ini?')">@csrf @method('PATCH')
                                            <button type="submit" title="Tolak" class="p-2 text-white bg-red-500 hover:bg-red-600 rounded-lg">
                                                 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.pendaftaran.batalkan', $siswa) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan status siswa ini?')">@csrf @method('PATCH')
                                            <button type="submit" title="Batalkan" class="p-2 text-white bg-gray-500 hover:bg-gray-600 rounded-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="p-6 text-center text-gray-500" colspan="5">Tidak ada data ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tampilan Mobile --}}
        <div class="grid grid-cols-1 gap-4 p-4 md:hidden">
            @forelse($siswas as $siswa)
                <div class="bg-white dark:bg-gray-800/50 p-4 rounded-lg shadow border dark:border-gray-700 space-y-3">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-bold text-gray-900 dark:text-white">{{ $siswa->nama_lengkap }}</p>
                            <p class="text-sm text-gray-500">{{ $siswa->nisn }}</p>
                        </div>
                        <span @class([
                            'px-2.5 py-1 text-xs font-semibold rounded-full',
                            'bg-yellow-100 text-yellow-800' => $siswa->status_pendaftaran == 'Pending',
                            'bg-green-100 text-green-800' => $siswa->status_pendaftaran == 'Diterima',
                            'bg-red-100 text-red-800' => $siswa->status_pendaftaran == 'Ditolak',
                        ])>
                            {{ $siswa->status_pendaftaran }}
                        </span>
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-300">
                        <p><span class="font-medium">Asal Sekolah:</span> {{ $siswa->asal_sekolah }}</p>
                    </div>
                    <div class="border-t dark:border-gray-600 pt-3 flex items-center justify-end gap-2">
                         <a href="{{ route('admin.pendaftaran.detail', $siswa)}}" class="flex-grow text-center text-white bg-indigo-500 hover:bg-indigo-600 font-medium rounded-lg text-xs px-3 py-2">
                            Detail
                        </a>
                        @if ($siswa->status_pendaftaran == 'Pending')
                            <form action="{{ route('admin.pendaftaran.terima', $siswa) }}" method="POST" onsubmit="return confirm('Yakin ingin menerima siswa ini?')">@csrf @method('PATCH')
                                <button type="submit" class="w-full text-white bg-green-500 hover:bg-green-600 font-medium rounded-lg text-xs px-3 py-2">Terima</button>
                            </form>
                            <form action="{{ route('admin.pendaftaran.tolak', $siswa) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak siswa ini?')">@csrf @method('PATCH')
                                <button type="submit" class="w-full text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-xs px-3 py-2">Tolak</button>
                            </form>
                        @else
                            <form action="{{ route('admin.pendaftaran.batalkan', $siswa) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan status siswa ini?')">@csrf @method('PATCH')
                                <button type="submit" class="w-full text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-lg text-xs px-3 py-2">Batalkan</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                 <div class="p-6 text-center text-gray-500">Tidak ada data ditemukan.</div>
            @endforelse
        </div>
    </div>

    {{-- Link Paginasi --}}
    <div class="mt-6">
        {{ $siswas->links() }}
    </div>
</div>
@endsection

