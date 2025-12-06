@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="flex flex-col w-full min-h-screen lg:h-[calc(100vh-64px)] px-2 gap-6 lg:overflow-hidden">

    {{-- Grid Statistik (Refactored Colors) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 shrink-0">
        
        <div class="rounded-xl bg-white p-5 shadow-sm border border-neutral-100 flex items-center gap-4 hover:border-primary-200 transition-colors">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-primary-50">
                <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.282-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.124-1.282.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-neutral-500">Total Pendaftar</p>
                <p class="text-2xl font-bold text-neutral-800">{{ $totalPendaftar }}</p>
            </div>
        </div>

        <div class="rounded-xl bg-white p-5 shadow-sm border border-neutral-100 flex items-center gap-4 hover:border-yellow-200 transition-colors">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-yellow-50">
                <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-neutral-500">Perlu Verifikasi</p>
                <p class="text-2xl font-bold text-neutral-800">{{ $pendaftarPending }}</p>
            </div>
        </div>

        <div class="rounded-xl bg-white p-5 shadow-sm border border-neutral-100 flex items-center gap-4 hover:border-primary-200 transition-colors">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-primary-100">
                <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-neutral-500">Siswa Diterima</p>
                <p class="text-2xl font-bold text-neutral-800">{{ $pendaftarDiterima }}</p>
            </div>
        </div>

        <div class="rounded-xl bg-white p-5 shadow-sm border border-neutral-100 flex items-center gap-4 hover:border-rose-200 transition-colors">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-rose-50">
                <svg class="h-6 w-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-neutral-500">Ditolak</p>
                <p class="text-2xl font-bold text-neutral-800">{{ $pendaftarDitolak }}</p>
            </div>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 flex-1 min-h-0">
        
        {{-- Chart --}}
        <div class="lg:col-span-2 rounded-xl bg-white shadow-sm border border-neutral-100 flex flex-col h-[400px] lg:h-auto">
            <div class="border-b border-neutral-100 px-6 py-4 shrink-0 flex justify-between items-center">
                <h3 class="text-base font-semibold leading-6 text-neutral-800">Grafik Pendaftar</h3>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-primary-500"></span>
                    <span class="text-xs font-medium text-neutral-500">30 Hari Terakhir</span>
                </div>
            </div>
            <div class="p-6 flex-1 relative">
                <div class="absolute inset-0 p-6">
                    <canvas id="pendaftaranChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Recent List --}}
        <div class="rounded-xl bg-white shadow-sm border border-neutral-100 flex flex-col h-[500px] lg:h-auto overflow-hidden">
            <div class="border-b border-neutral-100 px-6 py-4 shrink-0 flex items-center justify-between bg-white z-10">
                <h3 class="text-base font-semibold leading-6 text-neutral-800">Pendaftar Terbaru</h3>
                <a href="{{ route('admin.pendaftaran.semua') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 transition">Lihat Semua</a>
            </div>
            
            <div class="flex-1 overflow-y-auto custom-scrollbar">
                @forelse ($pendaftarTerbaru as $siswa)
                    <div class="group relative flex items-center gap-x-4 border-b border-neutral-50 p-4 hover:bg-neutral-50 transition last:border-0">
                        <div class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-primary-50 text-sm font-bold text-primary-600 ring-1 ring-primary-100">
                            {{ substr($siswa->nama_lengkap, 0, 2) }}
                        </div>
                        
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold leading-6 text-neutral-800 group-hover:text-primary-600 transition">
                                <a href="{{ route('admin.pendaftaran.detail', $siswa) }}">
                                    <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                    {{ $siswa->nama_lengkap }}
                                </a>
                            </p>
                            <p class="mt-1 flex text-xs leading-5 text-neutral-500">
                                <span class="truncate">{{ $siswa->asal_sekolah }}</span>
                            </p>
                        </div>
                        
                        <div class="flex flex-col items-end gap-y-1">
                            <p class="text-xs leading-5 text-neutral-400">{{ $siswa->created_at->diffForHumans() }}</p>
                            @php
                                $statusClasses = [
                                    'Pending' => 'bg-yellow-50 text-yellow-700 ring-yellow-600/20',
                                    'Diterima' => 'bg-primary-50 text-primary-700 ring-primary-600/20',
                                    'Ditolak' => 'bg-rose-50 text-rose-700 ring-rose-600/20',
                                ];
                                $class = $statusClasses[$siswa->status_pendaftaran] ?? 'bg-neutral-50 text-neutral-600 ring-neutral-500/10';
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $class }}">
                                {{ $siswa->status_pendaftaran }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center h-full text-center px-4 py-8">
                        <div class="rounded-full bg-neutral-50 p-3 mb-3">
                            <svg class="h-6 w-6 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-medium text-neutral-900">Belum ada pendaftar</h3>
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

            // Gradien Soft Teal
            let gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, '#14b8a6'); // Teal 500
            gradient.addColorStop(1, '#ccfbf1'); // Teal 100

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
                        borderRadius: 6,
                        barPercentage: 0.7,
                        categoryPercentage: 0.8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animations: {
                        y: { from: 100, duration: 1500, easing: 'easeOutQuart' }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#115e59', // Primary 800
                            padding: 12,
                            displayColors: false,
                            cornerRadius: 8,
                            titleFont: { size: 13, family: "'Poppins', sans-serif" },
                            bodyFont: { size: 13, family: "'Poppins', sans-serif" },
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: Math.max(...chartData) + 2,
                            border: { display: false },
                            grid: {
                                borderDash: [4, 4],
                                color: '#f5f5f4', // Neutral 100
                                drawBorder: false,
                            },
                            ticks: { stepSize: 1, font: { size: 11, family: "'Poppins', sans-serif" }, color: '#a8a29e' }
                        },
                        x: {
                            border: { display: false },
                            grid: { display: false },
                            ticks: { font: { size: 11, family: "'Poppins', sans-serif" }, color: '#a8a29e' }
                        }
                    },
                    interaction: { intersect: false, mode: 'index' },
                }
            });
        }
    });
</script>
@endsection