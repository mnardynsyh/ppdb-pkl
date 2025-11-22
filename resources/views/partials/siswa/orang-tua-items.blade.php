<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div>
        <p class="font-medium">Nama Lengkap</p>
        <p>{{ $data->nama_lengkap }}</p>
    </div>

    <div>
        <p class="font-medium">NIK</p>
        <p>{{ $data->nik }}</p>
    </div>

    <div>
        <p class="font-medium">Pekerjaan</p>
        <p>{{ $data->pekerjaan }}</p>
    </div>

    <div>
        <p class="font-medium">Penghasilan Bulanan</p>
        <p>{{ $data->penghasilan_bulanan }}</p>
    </div>

    <div class="md:col-span-2">
        <p class="font-medium">Alamat</p>
        <p>{{ $data->alamat }}</p>
    </div>

    <div>
        <p class="font-medium">No. HP</p>
        <p>{{ $data->no_hp }}</p>
    </div>

    <div>
        <p class="font-medium">Tanggal Lahir</p>
        <p>{{ $data->tanggal_lahir }}</p>
    </div>
</div>
