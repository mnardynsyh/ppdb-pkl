@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="flex flex-col w-full min-h-screen lg:h-[calc(100vh-64px)] bg-gray-50/50 px-4 py-14 lg:px-4 gap-6 lg:overflow-hidden">

    {{-- Grid Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 shrink-0">
        
        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-900/5 flex items-center gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-blue-50">
                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.282-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.124-1.282.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Pendaftar</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalPendaftar }}</p>
            </div>
        </div>

        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-900/5 flex items-center gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-yellow-50">
                <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Perlu Verifikasi</p>
                <p class="text-2xl font-bold text-gray-900">{{ $pendaftarPending }}</p>
            </div>
        </div>

        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-900/5 flex items-center gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-green-50">
                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Siswa Diterima</p>
                <p class="text-2xl font-bold text-gray-900">{{ $pendaftarDiterima }}</p>
            </div>
        </div>

        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-900/5 flex items-center gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-red-50">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Ditolak</p>
                <p class="text-2xl font-bold text-gray-900">{{ $pendaftarDitolak }}</p>
            </div>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 flex-1 min-h-0">
        
        {{-- Chart --}}
        <div class="lg:col-span-2 rounded-xl bg-white shadow-sm ring-1 ring-gray-900/5 flex flex-col h-[400px] lg:h-auto">
            <div class="border-b border-gray-100 px-6 py-4 shrink-0 flex justify-between items-center">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Grafik Pendaftar</h3>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    <span class="text-xs font-medium text-gray-500">30 Hari Terakhir</span>
                </div>
            </div>
            <div class="p-6 flex-1 relative">
                <div class="absolute inset-0 p-6">
                    <canvas id="pendaftaranChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Recent List --}}
        <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-900/5 flex flex-col h-[500px] lg:h-auto overflow-hidden">
            <div class="border-b border-gray-100 px-6 py-4 shrink-0 flex items-center justify-between bg-white z-10">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Pendaftar Terbaru</h3>
                <a href="{{ route('admin.pendaftaran.semua') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500 transition">Lihat Semua</a>
            </div>
            
            <div class="flex-1 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-200">
                @forelse ($pendaftarTerbaru as $siswa)
                    <div class="group relative flex items-center gap-x-4 border-b border-gray-50 p-4 hover:bg-gray-50 transition last:border-0">
                        <div class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-blue-50 text-sm font-bold text-blue-600 ring-1 ring-blue-100">
                            {{ substr($siswa->nama_lengkap, 0, 2) }}
                        </div>
                        
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold leading-6 text-gray-900 group-hover:text-blue-600 transition">
                                <a href="{{ route('admin.pendaftaran.detail', $siswa) }}">
                                    <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                    {{ $siswa->nama_lengkap }}
                                </a>
                            </p>
                            <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                <span class="truncate">{{ $siswa->asal_sekolah }}</span>
                            </p>
                        </div>
                        
                        <div class="flex flex-col items-end gap-y-1">
                            <p class="text-xs leading-5 text-gray-400">{{ $siswa->created_at->diffForHumans() }}</p>
                            @php
                                $statusClasses = [
                                    'Pending' => 'bg-yellow-50 text-yellow-700 ring-yellow-600/20',
                                    'Diterima' => 'bg-green-50 text-green-700 ring-green-600/20',
                                    'Ditolak' => 'bg-red-50 text-red-700 ring-red-600/20',
                                ];
                                $class = $statusClasses[$siswa->status_pendaftaran] ?? 'bg-gray-50 text-gray-600 ring-gray-500/10';
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $class }}">
                                {{ $siswa->status_pendaftaran }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center h-full text-center px-4 py-8">
                        <div class="rounded-full bg-gray-50 p-3 mb-3">
                            <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-medium text-gray-900">Belum ada pendaftar</h3>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('pendaftaranChart');

        if (ctx) {
            const chartData = @json($chartData);
            const chartLabels = @json($chartLabels);

            let gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, '#3b82f6');
            gradient.addColorStop(1, '#bfdbfe');

            if (window.myChart instanceof Chart) {
                window.myChart.destroy();
            }

            window.myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Pendaftar',
                        data: chartData,
                        backgroundColor: gradient,
                        borderRadius: 4,
                        barPercentage: 0.85,
                        categoryPercentage: 0.85
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    // ==================================================
                    //  PENGATURAN ANIMASI (BAWAH KE ATAS)
                    // ==================================================
                    animations: {
                        y: {
                            from: 100, // KUNCI: Mulai animasi dari nilai 0 (Bawah)
                            duration: 1500, // Durasi 1 detik
                            easing: 'easeOutQuart' // Gerakan cepat di awal, melambat di akhir (halus)
                        }
                    },
                    // ==================================================

                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#111827',
                            padding: 12,
                            displayColors: false,
                            cornerRadius: 8,
                            titleFont: { size: 13, family: "'Poppins', sans-serif" },
                            bodyFont: { size: 13, family: "'Poppins', sans-serif" },
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' Siswa';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            // Tambah ruang +2 di atas agar tidak mentok
                            suggestedMax: Math.max(...chartData) + 1,
                            border: { display: false },
                            grid: {
                                borderDash: [8, 4],
                                color: '#f3f4f6',
                                drawBorder: false,
                            },
                            ticks: {
                                stepSize: 1,
                                font: { size: 11, family: "'Poppins', sans-serif" },
                                color: '#9ca3af',
                                padding: 10
                            }
                        },
                        x: {
                            border: { display: false },
                            grid: { display: false },
                            ticks: {
                                font: { size: 11, family: "'Poppins', sans-serif" },
                                color: '#9ca3af',
                                padding: 10
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            });
        }
    });
</script>
@endsection