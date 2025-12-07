<div class="grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-x-6">
    {{-- Nama Lengkap --}}
    <div class="pb-3 border-b border-neutral-50 sm:border-0">
        <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-1">Nama Lengkap</p>
        <p class="text-sm font-bold text-neutral-900">{{ $data->nama_lengkap ?? '-' }}</p>
    </div>

    {{-- NIK --}}
    <div class="pb-3 border-b border-neutral-50 sm:border-0">
        <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-1">NIK</p>
        <p class="text-sm font-medium text-neutral-800 font-mono">{{ $data->nik ?? '-' }}</p>
    </div>

    {{-- Tempat, Tanggal Lahir --}}
    <div class="pb-3 border-b border-neutral-50 sm:border-0">
        <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-1">Tempat, Tanggal Lahir</p>
        <p class="text-sm font-medium text-neutral-800">
            {{ $data->tempat_lahir ?? '-' }}, 
            {{ $data->tanggal_lahir ? \Carbon\Carbon::parse($data->tanggal_lahir)->isoFormat('D MMMM Y') : '-' }}
        </p>
    </div>

    {{-- Pekerjaan --}}
    <div class="pb-3 border-b border-neutral-50 sm:border-0">
        <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-1">Pekerjaan</p>
        <p class="text-sm font-medium text-neutral-800">{{ $data->pekerjaan ?? '-' }}</p>
    </div>

    {{-- Penghasilan --}}
    <div class="pb-3 border-b border-neutral-50 sm:border-0">
        <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-1">Penghasilan</p>
        <p class="text-sm font-medium text-neutral-800">{{ $data->penghasilan_bulanan ?? '-' }}</p>
    </div>

    {{-- agama --}}
    <div class="pb-3 border-b border-neutral-50 sm:border-0">
        <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-1">Penghasilan</p>
        <p class="text-sm font-medium text-neutral-800">{{ $data->agama ?? '-' }}</p>
    </div>

    {{-- No. HP --}}
    <div class="pb-3 border-b border-neutral-50 sm:border-0">
        <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-1">No. Handphone</p>
        <p class="text-sm font-medium text-neutral-800">{{ $data->no_hp ?? '-' }}</p>
    </div>
</div>