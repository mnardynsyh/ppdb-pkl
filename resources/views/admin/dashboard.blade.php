@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="p-4 sm:p-6 mt-8">

    {{-- Grid untuk Kartu Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        {{-- Total Pendaftar --}}
        <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow-md flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Total Pendaftar</div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalPendaftar }}</div>
            </div>
            <div class="p-3 bg-blue-100 dark:bg-blue-900/50 rounded-full">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.282-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.124-1.282.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>
        {{-- Pendaftar Pending --}}
        <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow-md flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Pendaftar Masuk</div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $pendaftarPending }}</div>
            </div>
            <div class="p-3 bg-yellow-100 dark:bg-yellow-900/50 rounded-full">
                 <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        {{-- Pendaftar Diterima --}}
        <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow-md flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Diterima</div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $pendaftarDiterima }}</div>
            </div>
            <div class="p-3 bg-green-100 dark:bg-green-900/50 rounded-full">
                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        {{-- Pendaftar Ditolak --}}
        <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow-md flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Ditolak</div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $pendaftarDitolak }}</div>
            </div>
            <div class="p-3 bg-red-100 dark:bg-red-900/50 rounded-full">
                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
            </div>
        </div>
    </div>

    {{-- Grid untuk Grafik dan Aktivitas Terbaru --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Grafik Pendaftaran --}}
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Grafik Pendaftaran (30 Hari Terakhir)</h3>
            <canvas id="pendaftaranChart"></canvas>
        </div>

        {{-- Aktivitas Terbaru & Pengaturan --}}
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Pendaftar Terbaru</h3>
                <div class="space-y-4">
                    @forelse ($pendaftarTerbaru as $siswa)
                        <a href="{{ route('admin.pendaftaran.detail', $siswa) }}" class="block p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition duration-300">
                            <div class="flex items-center justify-between">
                                <p class="font-semibold text-sm text-gray-800 dark:text-gray-100">{{ $siswa->nama_lengkap }}</p>
                                <p class="text-xs text-gray-400">{{ $siswa->created_at->diffForHumans() }}</p>
                            </div>
                            <p class="text-xs text-gray-500">{{ $siswa->asal_sekolah }}</p>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada pendaftar baru.</p>
                    @endforelse
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Status Pendaftaran</h3>
                @if($pengaturan)
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Status</span>
                            <span class="font-semibold px-2 py-1 rounded-full text-xs
                                {{ $pengaturan->status == 'Dibuka' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $pengaturan->status }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Tanggal Buka</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($pengaturan->tanggal_buka)->isoFormat('D MMM YYYY') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Tanggal Tutup</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($pengaturan->tanggal_tutup)->isoFormat('D MMM YYYY') }}</span>
                        </div>
                    </div>
                     <a href="{{ route('admin.pengaturan.index') }}" class="mt-4 w-full block text-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                        Ubah Pengaturan
                    </a>
                @else
                    <p class="text-sm text-gray-500">Pengaturan belum dikonfigurasi.</p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Script untuk Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pendaftaranChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Jumlah Pendaftar',
                data: @json($chartData),
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endsection
